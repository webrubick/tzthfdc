<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends MY_Controller {
	
	// 后台的管理登录界面
	const ADMIN_LOGIN = 'admin/user/login';
	
	public function __construct() {
		parent::__construct();
		$this->load_sessionaccess();
	}
	
	// 显示管理当前用户所属组能够操作的管理后台界面
	public function index()
	{
		$this->check_state_common('GET', TRUE);
		// 如果已经登录，则显示当前用户能够看到的管理界面
		$this->load->view('admin/index', $this);
	}
	
	// 管理后台登陆
	public function login() {
		$this->check_state_common('GET', FALSE);
		if (is_login()) {
			// 如果已经登录，则显示当前用户能够看到的管理界面
			redirect(base_url('admin'));
		} else {
			// 如果没有登录
			$this->load->view($this::ADMIN_LOGIN, $this);
		}
	}

	public function login_ajax() {
		$this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);
		$user_name = isset($post['user_name']) ? trim($post['user_name']) : NULL;
		$password = isset($post['password']) ? trim($post['password']) : NULL;

		$this->load->api('user_api');
		$api_result = $this->user_api->login($user_name, $password);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('admin');
		}
		echo json_encode($api_result);
	}


	// 用户注册，此处是经纪人注册
	public function register() {
		$this->check_state_common('GET', FALSE);
		$this->load->view('admin/user/register', $this);
	}
	
	public function register_ajax() {
		$this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$this->load->api('user_api');
		$api_result = $this->user_api->register($post);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('admin/login');
		}
		echo json_encode($api_result);
	}

	// 管理后台注销登陆
	public function logout() {
		$this->check_state_common('GET', FALSE);
		
		$this->load->api('user_api');
		$this->user_api->logout();
		// 如果没有登录
		redirect(base_url('admin/login'));
	}

	// 加载验证码
	public function checkcode() {
		$this->load->library('checkcode');
	    $this->checkcode->show(function ($verify_code) {
	    	$this->session->set_userdata('verify_code', $verify_code);
	    });
	}


}

?>