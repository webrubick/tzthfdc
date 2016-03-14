<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 * 默认加载了一些辅助类：url；
 *
 */
class MY_Controller extends CI_Controller {

	public function __construct() {
	    parent::__construct();
		// 需要base url
        $this->load->helper('url');
	}
	
	//=========================================
	// 用户相关
	//=========================================
	/**
	 * 是否已登录
	 */
	public function is_login() {
	    if (isset($this->sessionaccess)) {
	        return is_login();
	    }
	    return FALSE;
	}
	
	/**
	 * 获取UID，如果用户已经登录，返回用户ID，
	 * 
	 * 如果没有登录则返回NULL
	 */
	public function get_uid() {
	    if (isset($this->sessionaccess)) {
	        return get_session_uid();
	    }
	    return NULL;
	}
	
	/**
	 * 获取用户信息并将用户信息加载到当前对象，
	 * 
	 * 如果用户已经登录
	 */
	public function view_data($extra = NULL) {
	    if (isset($this->sessionaccess)) {
	        $user_info = get_sim_user_info();
            if (isset($user_info) && !empty($user_info)) {
    			foreach ($user_info as $key => $value) {
    	        	$this->$key = $value;
    	        }
            }
	    }
	    if (is_array($extra) && !empty($extra)) {
	        foreach ($extra as $key => $value) {
	        	$this->$key = $value;
	        }
	    }
	    return $this;
	}




    // ================================================
    // 公共方法
    // ================================================
	public function check_state_common($request_method, $need_login = FALSE) {
		if (isset($request_method)) {
			$cur_req_method = $this->input->method(TRUE);
			$request_method = strtoupper($request_method);
			if ($cur_req_method != $request_method) {
				ishow_404('required method is \''.$request_method.'\', but now is \''.$cur_req_method.'\'');
			}
		}
		if ($need_login) {
			if (!$this->is_login()) {
				// 如果没有登录
				redirect(base_url('admin/login'));
				exit(EXIT_UNKNOWN_FILE);
			}
		}
	}
	
	public function check_param($param_name) {
		$val = $this->input->get_post($param_name, TRUE);
		if (!isset($val)) {
			ishow_error('No param \''.$param_name.'\'', 'You should provide \''.$param_name.'\' as a parameter', 400);
		}
		return $val;
	}
	
}

?>