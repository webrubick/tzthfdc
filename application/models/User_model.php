<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 用户相关的API，包括登录，注册，修改密码，修改信息；
 */
class user_model extends MY_Model {
	
	// 表名
	const TABLE_NAME = 'tab_user';

	private $COLS = array(
		'uid', 'user_name', 'true_name', 'password', 'salt', 'sex',
		'contact_tel', 'contact_mobile', 'qqchat', 'wechat', 'email', 'address', 'avatar',
		'permission'
	);
	
	public function __construct() {
		parent::__construct();
	}

	public function get_all() {
		$this->setTable($this::TABLE_NAME);
		return $this->getData();
	}

	/**
	 * 根据用户ID获取用户信息
	 *
	 * @param	string	$uid 用户ID
	 * @return	array 	$uid的用户信息，或者空数组
	 * @see CI_DB_result::result_array
	 */
	public function get_by_id($uid) {
		$this->setTable($this::TABLE_NAME);
		return $this->getSingle(array('uid'=>$uid));	
	}

	/**
	 * 根据用户名获取用户信息
	 *
	 * @param	string	$user_name 用户名
	 * @return	array 	$user_name的用户信息，或者空数组
	 * @see CI_DB_result::result_array
	 */
	public function get_by_name($user_name) {
		$this->setTable($this::TABLE_NAME);
		return $this->getSingle(array('user_name'=>$user_name));	
	}

	/**
	 * 根据用户名判断是否存在该用户
	 *
	 * @param	string	$user_name 用户名
	 * @return	bool 	是否存在该用户
	 * @see empty(CI_DB_result::result_array)
	 */
	public function exist_by_name($user_name) {
		$this->setTable($this::TABLE_NAME);
		$result = $this->get_by_name($user_name);
		return !empty($result);
	}

	/**
	 * 增加用户
	 *
	 * @param	user	$uid 用户名
	 * @return	insert_id or false 
	 * @see CI_DB_result::insert  db->insert_id()
	 */
	public function add_user($user) {
		$user = array_filter_by_key($user, $this->COLS);
		$this->setTable($this::TABLE_NAME);
		$result = $this->addData($user);
		return isset($result);
	}

	/**
	 * 修改用户信息
	 *
	 * @param	string	$uid 用户ID
	 * @param	string	$fields 用户信息
	 * @return	bool	TRUE on success, FALSE on failure
	 * @see CI_DB_query_builder::update
	 */
	public function update_by_id($uid, $fields) {
		$fields = array_filter_by_key($fields, $this->COLS);
		$this->setTable($this::TABLE_NAME);
		return $this->editData(array('uid' => $uid), $fields);
	}

	/**
	 * 删除用户
	 *
	 * @param	string	$uid 用户ID
	 * @return	bool	TRUE on success, FALSE on failure
	 * @see CI_DB_query_builder::delte
	 */
	public function del_by_id($uid) {
		$result = $this->delData($uid, $this::TABLE_NAME, 'uid');
		return $result === FALSE ? FALSE : TRUE;
	}
	





	public function get_all_but_self($uid) {
		$this->setTable($this::TABLE_NAME);
		$this->db->select(array('uid', 'user_name', 'true_name', 'permission'));
		$this->db->where_not_in('uid', array($uid));
		return $this->getData();
	}

	public function update_permission($uid, $permission) {
		$fields = array('permission' => $permission);
		$this->setTable($this::TABLE_NAME);
		return $this->editData(array('uid' => $uid), $fields);

	}
}

?>