<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 用户相关的API，包括登录，注册，修改密码，修改信息；
 */
class user_api extends API {
	
	protected $apicode = array(

		// 登录时API
		90001 => '用户名为空',
		90002 => '密码为空',
		90003 => '用户不存在',
		90004 => '用户名与密码不匹配',
		90005 => '验证码为空',

		// 注册时API
		90101 => '注册信息缺失',
		90102 => '用户名已存在',
		90103 => '注册失败',
		90104 => '至少6位密码',

		90201 => '密码修改失败',

		90301 => '用户信息更新失败',
		90302 => '头像上传失败',
		90303 => '头像更新失败',

		90401 => '指定删除用户ID',
		90402 => '删除用户失败',

		90501 => '超级用户信息丢失',
		90502 => '授权信息更新失败',
		90503 => '授权参数缺失',

	);

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	/**
	 * 用户登录
	 */
	public function login($user_name, $user_pass) {
		if (!isset($user_name)) { return $this->ex(90001); }
		if (!isset($user_pass)) { return $this->ex(90002); }

		$query_user = $this->user_model->get_by_name($user_name);
		if (empty($query_user)) { return $this->ex(90003); }

		if (md5pass($user_pass, $query_user['salt']) != $query_user['password']) {
			return $this->ex(90004);
		} else {
			return $this->ok(prepare_user_info($query_user));
		}
	}

	/**
	 * 用户注册
	 */
	public function register($user) {
		if (!isset($user) || empty($user)) { return $this->ex(90101); }
		if (!isset($user['user_name']) || empty($user['user_name'])) { return $this->ex(90001); }
		if (!isset($user['password']) || empty($user['password'])) { return $this->ex(90002); }
		// check exist
		// 检测用户名有没有注册过
		if ($this->user_model->exist_by_name($user['user_name'])) { return $this->ex(90102); }
		
		$user_pass = $user['password'];
		$parsed_user = array_merge($user, $this->generate_user_pass($user_pass));
		log_message('info', 'register user_pass = '.$parsed_user['password']);
		// do set new user
		$insert_result = $this->user_model->add_user($parsed_user);
		if (!$insert_result) {
			log_message('error', 'register db failed');
			return $this->ex(90103);
		}
		// 如果成功返回login数据
		return $this->login($parsed_user['user_name'], $user_pass);
	}



	// *************************************
	// 修改密码
	// *************************************
	/**
	 * 修改密码
	 *
	 * @param	string	$user_pass 用户修改后的密码
	 * @param	mixed	$user 当前用户信息
	 */
	public function change_pass($user_pass) {
		if (!is_login()) { return $this->un_login(); }
		if (!isset($user_pass) || empty($user_pass)) { return $this->ex(90002); }
		$uid = get_session_uid();

		$update_pair = $this->generate_user_pass($user_pass);
		log_message('error', 'change_pass update_pair = '.json_encode($update_pair));
		// 尝试更新数据库
		$update_result = $this->user_model->update_by_id($uid, $update_pair);
		if (!$update_result) {
			log_message('error', 'change_pass db failed');
			return $this->ex(90201);
		}

		$user_after_update = array_merge($this->sessionaccess->get_user_info(), $update_pair);
		log_message('error', 'change_pass user_after_update = '.json_encode($update_pair));
		return $this->ok(prepare_user_info($user_after_update));
	}


	// *************************************
	// 修改个人信息
	// *************************************
	public function update_info($update_pair) {
		if (!is_login()) {
			return $this->un_login();
		}
		if (!isset($update_pair) || !is_array($update_pair)) {
			return $this->ok();
		}
		// 更新数据库
		$uid = get_session_uid();
		$update_result = $this->user_model->update_by_id($uid, $update_pair);
		if (!$update_result) {
			log_message('error', 'update_info db failed');
			return $this->ex(90301);
		} else {
			return $this->ok(prepare_user_info($this->user_model->get_by_id($uid)));
		}
	}

	public function update_avatar() {
		if (!is_login()) { return $this->un_login(); }

		$uid = get_session_uid();

		$this->load->helper('upload');
		$save_result = save_avatar($this, $uid);

		if (is_ok_result($save_result)) {
			$avatar = $save_result['data']; // 新的头像地址
			$update_result = $this->user_model->update_by_id($uid, array('avatar' => $avatar));
			if (!$update_result) {
				log_message('error', 'update_avatar db failed');
				// 删除文件，因为并没有更新成功
				delete_avatar($avatar);
				return $this->ex(90303);
			} else {
				delete_old_avatar($this, $avatar); // 删除老的头像文件
				set_user_field('avatar', $avatar); // 更新session
				return $this->ok($avatar);
			}
		} else {
			return $this->ex(90302);
		}
	}


	public function del_user($uid) {
		if (!is_login()) {
			return $this->un_login();
		}
		if (!isset($uid)) {
			return $this->ex(90401);
		}
		$del_result = $this->user_model->del_by_id($uid);
		if (!$del_result) {
			log_message('error', 'del_user db failed');
			return $this->ex(90402);
		} else {
			return $this->ok($uid);
		}
	}

	/**
	 * 注销
	 */
	public function logout() {
		clear_login();
		return $this->ok();
	}

	/**
	 * 根据UI层的密码生成用户密码
	 */
	private function generate_user_pass($user_pass) {
		$this->load->helper('string');
		$salt = random_string('alnum', 6);
		$password = md5pass($user_pass, $salt);
		return array(
			'password' => $password,
			'salt' => $salt
		);
	}



	// *************************************
	// 授权
	// *************************************
	public function get_all_user_by_super($uid) {
		if (!is_login()) {
			return $this->un_login();
		}
		if (!isset($uid)) {
			return $this->ex(90502);
		}
		$query_user = $this->user_model->get_all_but_self($uid);
		return $this->ok($query_user);
	}

	public function grant($uid, $permission) {
		if (!is_login()) {
			return $this->un_login();
		}
		if (!isset($uid) || !isset($permission)) {
			return $this->ex(90503);
		}
		$update_result = $this->user_model->update_permission($uid, $permission);
		if (!$update_result) {
			log_message('error', 'update_permission db failed');
			return $this->ex(90502);
		} else {
			return $this->ok();
		}

	}
}


?>