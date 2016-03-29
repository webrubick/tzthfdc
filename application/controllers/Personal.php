<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personal extends MY_Controller {
	
	protected $unlogin_url = ''; // 回到首页
	
	public function __construct() {
		parent::__construct();
		$this->load_sessionaccess();
	}
	
	public function index() {
		$this->check_state_common('GET', TRUE);
		// 如果已经登录，则显示当前用户能够看到的管理界面
		$this->load->view('admin/index', $this);
	}
	
	// >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
	// 用户登录注册
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
		$api_result['data'] = base_url();
		echo json_encode($api_result);
    }

    // 登录注册 end
	
}

?>