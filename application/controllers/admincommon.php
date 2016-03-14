<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admincommon extends MY_Controller {
	
	// 后台的管理登录界面
	const ADMIN_LOGIN = 'admin/user/login';
	
	public function __construct() {
		parent::__construct();
	}
	
	// 进入管理小区的界面
	public function community() {
		$this->check_state_common('GET', TRUE);

		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->community_list();
		if (is_ok_result($api_result)) {
			$this->communitys = $api_result['data'];
			$this->load->view('admin/common/community', $this);
		} else {
			ishow_error_msg($api_result['msg']);
		}
	}

	public function community_index() {
		$this->community();
	}

	// 新增小区
	public function community_add_ajax() {
		$this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL, TRUE);
		$names = isset($post['name']) ? trim($post['name']) : NULL;
		if (!empty($names) && strrpos($names, "\n") !== FALSE) {
			$names = array_filter(explode("\n", $names));
		}
		
		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->community_add($names);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('admincommon/community');
		}
		echo json_encode($api_result);
	}

	public function community_edit_ajax() {
		$this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL, TRUE);
		$cid = isset($post['id']) ? trim($post['id']) : NULL;
		$cname = isset($post['name']) ? trim($post['name']) : NULL;
		
		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->community_edit($cid, $cname);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('admincommon/community');
		}
		echo json_encode($api_result);
	}

	public function community_del() {
		$this->check_state_common('GET', TRUE);
		// 获取所有的数据
		$get = $this->input->get(NULL, TRUE);
		$cid = isset($get['cid']) ? trim($get['cid']) : NULL;
		
		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->community_del($cid);
		if (is_ok_result($api_result)) {
			$this->community();
		} else {
			ishow_error_msg($api_result['msg']);
		}
	}
	
	// 进入管理区域的界面
	public function area() {
		$this->check_state_common('GET', TRUE);

		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->area_list();
		if (is_ok_result($api_result)) {
			$this->areas = $api_result['data'];
			$this->load->view('admin/common/area', $this);
		} else {
			ishow_error_msg($api_result['msg']);
		}
	}

	// 新增区域
	public function area_add_ajax() {
		$this->check_state_api('POST');

		// 获取所有的数据
		$post = $this->input->post(NULL, TRUE);
		$names = isset($post['name']) ? trim($post['name']) : NULL;
		if (!empty($names) && strrpos($names, "\n") !== FALSE) {
			$names = array_filter(explode("\n", $names));
		}
		
		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->area_add($names);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('admincommon/area');
		}
		echo json_encode($api_result);
	}

	public function area_edit_ajax() {
		$this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL, TRUE);
		$aid = isset($post['id']) ? trim($post['id']) : NULL;
		$area_name = isset($post['name']) ? trim($post['name']) : NULL;
		
		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->area_edit($aid, $area_name);
		if (is_ok_result($api_result)) {
			$api_result['data'] = base_url('admincommon/area');
		}
		echo json_encode($api_result);
	}

	public function area_del() {
		$this->check_state_common('GET', TRUE);
		// 获取所有的数据
		$get = $this->input->get(NULL, TRUE);
		$aid = isset($get['aid']) ? trim($get['aid']) : NULL;
		
		$this->load->api('admincommon_api');
		$api_result = $this->admincommon_api->area_del($aid);
		if (is_ok_result($api_result)) {
			$this->area();
		} else {
			ishow_error_msg($api_result['msg']);
		}
	}
}


?>