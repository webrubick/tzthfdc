<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// 快捷的判断是否已经登录
function is_login() {
	$CI =& get_instance();
	return $CI->sessionaccess->check_login();
}

// 快捷的清除login信息
function clear_login() {
	$CI =& get_instance();
	return $CI->sessionaccess->clear_user_info();
}

// 尽量少调用
function get_session_uid() {
	$CI =& get_instance();
	return $CI->sessionaccess->get_field('uid');
}

function set_raw_user_info($user) {
	$CI =& get_instance();
	$CI->sessionaccess->set_user_info($user);
}

function set_user_field($key, $val = NULL) {
	$CI =& get_instance();
	$CI->sessionaccess->set_field($key, $val);
}

function get_user_field($key) {
	$CI =& get_instance();
	return $CI->sessionaccess->get_field($key);
}

// 获取尽可能少的用户信息
function get_sim_user_info() {
	$CI =& get_instance();
	return $CI->sessionaccess->filter_sim();
}

// 用户登录/注册模块使用
function prepare_user_info($query_user) {
	// set raw
	set_raw_user_info($query_user);
	return get_sim_user_info();
}

/**
 * User login Session access manager
 */
class sessionaccess {
	// 一般用户登录状态中都要含有一些公共信息
	const COOKIE_EXPIRE = 86500;
	
	protected $CI;
	protected $sim_info_keys = array(
			'uid',
			'user_name', 'true_name',
			'sex',
			'contact_tel', 'contact_mobile',
			'qqchat', 'wechat', 'email',
			'avatar', 
			'gid',
			'permission'
	);
	
    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct()
    {
        // Assign the CodeIgniter super-object
		$this->CI =& get_instance();
		$this->CI->load->library('session');
    }

    public function check_login(/*$input = NULL*/) {
		$session_uid = $this->CI->session->userdata('uid');
		return (isset($session_uid) && !empty($session_uid));
	}

	/**
	 * 设置cookie
	 */
	public function set_user_info($user_info) {
		$this->CI->session->set_userdata($user_info);
	}
	
	/**
	 * 返回用户相关的数据
	 */
	public function get_user_info() {
		return $this->CI->session->userdata();
	}

	/**
	 * 设置单个的cookie
	 */
	public function set_field($key, $val = NULL) {
		$this->CI->session->set_userdata($key, $val);
	}

	/**
	 * 获取单个的cookie
	 */
	public function get_field($key) {
		return $this->CI->session->userdata($key);
	}

	/**
	 * 清空用户信息
	 */
	public function clear_user_info() {
		$this->CI->session->unset_userdata($this->sim_info_keys);
	}

	/**
	 * 获得对外提供的简单信息
	 */
	public function filter_sim() {
		$user_info = $this->get_user_info();
		return array_filter_by_key($user_info, $this->sim_info_keys);
	}
	
}

?>