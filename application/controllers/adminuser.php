<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 管理用户
class adminuser extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load_sessionaccess();
	}

	public function edit() {
		$this->check_state_common('GET', TRUE);
		$this->load->view('admin/user/edit-user', $this);
	}

	public function edit_ajax() {
		$this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL, TRUE);
		$this->load->api('user_api');
		$api_result = $this->user_api->update_info($post);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('adminuser/edit');
		}
		echo json_encode($api_result);
	}

	public function edit_password() {
		$this->check_state_common('GET', TRUE);
		$this->load->view('admin/user/edit-password', $this);
	}

	public function edit_password_ajax() {
		$this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL, TRUE);
		if (isset($post['password'])) {
			$user_pass = $post['password'];
		}
		$this->load->api('user_api');
		$api_result = $this->user_api->change_pass($user_pass);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('admin');
		}
		echo json_encode($api_result);
	}

	public function avatar() {
		$this->check_state_api('POST');

		$this->load->api('user_api');
		$api_result = $this->user_api->update_avatar();
		echo json_encode($api_result);
	}

	public function grant() {
		$this->check_state_common('GET', TRUE);

		$uid = get_session_uid();
		if (!isset($uid) || $uid != 1) {
			ishow_error('Forbidden', 'Not Super User', 403);
		}
		$this->load->api('user_api');
		$api_result = $this->user_api->get_all_user_by_super($uid);
		if (is_ok_result($api_result)) {
			$this->grant_users = $api_result['data'];
		}
		$this->load->view('admin/user/grant', $this);
	}

	public function grant_ajax() {
		$this->check_state_api('POST');

		// 获取所有的数据
		$uid = $this->input->post('uid', TRUE);
		$permission = $this->input->post('permission', TRUE);
		if (!isset($permission) || empty($permission)) {
			$permission = 0;
		} else {
			$permission = 1;
		}
		$this->load->api('user_api');
		$api_result = $this->user_api->grant($uid, $permission);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('adminuser/grant');
		}
		echo json_encode($api_result);
	}

	// public function add() {
	// 	$this->check_state_common('GET', TRUE);
	// }

	// public function del() {
	// 	$this->check_state_common('GET', TRUE);

	// 	$post = $this->input->post('id',TRUE);
	// 	$id = !empty($post) ? $post : array($this->input->get('id',TRUE));
	// 	if (is_array($id) && in_array('1',$id)) {
	// 		$tag = false;
	// 	} 
	// }

}

?>