<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load_sessionaccess();
	}

	public function index() {
		redirect(base_url('sellhouse'));
	}
	
	public function login() {
	    $this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);
		$user_name = isset($post['user_name']) ? trim($post['user_name']) : NULL;
		$password = isset($post['password']) ? trim($post['password']) : NULL;
		$code = isset($post['code']) ? trim($post['code']) : NULL;

		$this->load->api('user_api');
		$api_result = $this->user_api->login_personal($user_name, $password, $code);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url();
		}
		echo json_encode($api_result);
	}
	
	public function register() {
	    $this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$this->load->api('user_api');
		$api_result = $this->user_api->register_persional($post);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url();
		}
		echo json_encode($api_result);
	}

    public function login_vercode() {
        $this->load->library('checkcode');
	    $this->checkcode->show(function ($verify_code) {
	    	$this->session->set_userdata('login_vercode', $verify_code);
	    });
    }

    public function register_vercode() {
        $this->load->library('checkcode');
	    $this->checkcode->show(function ($verify_code) {
	    	$this->session->set_userdata('register_vercode', $verify_code);
	    });
    }
    
    public function logout() {
		$this->load->api('user_api');
		$api_result = $this->user_api->logout();
		echo json_encode($api_result);
    }

}

?>