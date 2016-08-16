<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 管理用户的房源
class Adminhouse extends MY_Controller {

	protected $unlogin_url = 'admin/login';
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('house');
		$this->load_sessionaccess();
	}

	public function index() {
		$this->check_state_common('GET', TRUE);

		// 获取当前分类
		$this->generate_cat_kw();
		$uid = get_session_uid();

		if ($this->cat == 0) {
			$this->load->api('adminsellhouse_api');
			$list_result = $this->adminsellhouse_api->sell_list($uid, $this->kw);
		} else {
			$this->load->api('adminrenthouse_api');
			$list_result = $this->adminrenthouse_api->rent_list($uid, $this->kw);
		}
		$this->houses = $list_result['data'];
		$this->load->view('admin/house/house-index', $this);
	}

	public function sell_index() {
		$this->check_state_common('GET', TRUE);
		// 获取当前分类
		$this->generate_cat_kw();
		$this->cat = 0;
		$uid = get_session_uid();

		$this->load->api('adminsellhouse_api');
		$list_result = $this->adminsellhouse_api->sell_list($uid, $this->kw);

		$this->houses = $list_result['data'];
		$this->load->view('admin/house/sell-index', $this);
	}

	public function rent_index() {
		$this->check_state_common('GET', TRUE);
		// 获取当前分类
		$this->generate_cat_kw();
		$this->cat = 1;
		$uid = get_session_uid();

		$this->load->api('adminrenthouse_api');
		$list_result = $this->adminrenthouse_api->rent_list($uid, $this->kw);

		$this->houses = $list_result['data'];
		$this->load->view('admin/house/rent-index', $this);
	}

	private function generate_cat_kw() {
		$cat = $this->input->get_post('cat', TRUE);
		if (!isset($cat) || empty($cat) || intval($cat) == 0) {
			$cat = 0;
		} else {
			$cat = 1;
		}
		$this->cat = $cat; // save cat variable

		// 获取当前关键词
		$kw = $this->input->get_post('kw', TRUE);
		if (!isset($kw) || empty($kw)) {
			$kw = '';
		}
		$this->kw = $kw;
	}


	// **************************************************
	// **************************************************
	// sell house
	// **************************************************
	// **************************************************
	public function add_sell() {
		$this->check_state_common('GET', TRUE);
		loadCommonInfos($this);
		$this->load->view('admin/house/add-sell', $this);
	}

	public function add_sell_ajax() {
		$this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$uid = get_session_uid();

		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->add_sell($uid, $post);
		if (is_ok_result($api_result)) {
			$hid = $api_result['data'];
			$api_result['data'] = array(
				'url' => base_url('adminhouse/add_sell'),
				'hid' => $hid
			);
		}
		echo json_encode($api_result);
	}

	public function edit_sell() {
		$this->check_state_common('GET', TRUE);

		$hid = $this->check_param('hid');
		$uid = get_session_uid();

		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->sell_item($uid, $hid);
		if (is_ok_result($api_result)) {
			loadCommonInfos($this);
			$this->house = $api_result['data'];
			$this->load->view('admin/house/edit-sell', $this);
		} else {
			redirect(base_url('adminhouse/index'));
		}
	}

	public function edit_sell_ajax() {
		$this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$uid = get_session_uid();
		$hid = $this->input->post('hid',TRUE);

		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->update_sell($uid, $hid, $post);
		if (is_ok_result($api_result)) {
			$api_result['data'] = array(
				'url' => base_url('adminhouse/edit_sell').'?hid='.$hid,
				'hid' => $hid
			);
		}
		echo json_encode($api_result);
	}

	public function del_sell_ajax() {
		$this->check_state_api('POST');

		$uid = get_session_uid();
		$hid = $this->input->post('hid',TRUE);

		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->del_sell($uid, $hid);
		if (is_ok_result($api_result)) {
			$this->generate_cat_kw();
			$api_result['data'] = base_url('adminhouse/sell_index').'?cat='.$this->cat.'&kw='.$this->kw;
		}
		echo json_encode($api_result);
	}

	public function sell_image() {
		$this->check_state_api('POST');

		$uid = get_session_uid();
		$hid = $this->check_param_api('hid');

		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->update_sell_image($uid, $hid);
		echo json_encode($api_result);
	}

	public function del_sell_image() {
		$this->check_state_api('POST');
		$uid = get_session_uid();
		$hid = $this->check_param_api('hid');
		$image = $this->check_param_api('image');
		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->del_sell_image($uid, $hid, $image);
		echo json_encode($api_result);
	}



	// **************************************************
	// **************************************************
	// rent house
	// **************************************************
	// **************************************************
	public function add_rent() {
		$this->check_state_common('GET', TRUE);
		loadRentCommonInfos($this);
		$this->load->view('admin/house/add-rent', $this);
	}

	public function add_rent_ajax() {
		$this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$uid = get_session_uid();

		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->add_rent($uid, $post);
		if (is_ok_result($api_result)) {
			$hid = $api_result['data'];
			$api_result['data'] = array(
				'url' => base_url('adminhouse/add_rent'),
				'hid' => $hid
			);
		}
		echo json_encode($api_result);
	}

	public function edit_rent() {
		$this->check_state_common('GET', TRUE);

		$hid = $this->check_param('hid');
		$uid = get_session_uid();

		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->rent_item($uid, $hid);
		if (is_ok_result($api_result)) {
			loadRentCommonInfos($this);
			$this->house = $api_result['data'];
			$this->load->view('admin/house/edit-rent', $this);
		} else {
			redirect(base_url('adminhouse/index'));
		}
	}

	public function edit_rent_ajax() {
		$this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$uid = get_session_uid();
		$hid = $this->input->post('hid',TRUE);

		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->update_rent($uid, $hid, $post);
		if (is_ok_result($api_result)) {
			$api_result['data'] = array(
				'url' => base_url('adminhouse/edit_rent').'?hid='.$hid,
				'hid' => $hid
			);
		}
		echo json_encode($api_result);
	}

	public function del_rent_ajax() {
		$this->check_state_api('POST');

		$uid = get_session_uid();
		$hid = $this->input->post('hid',TRUE);

		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->del_rent($uid, $hid);
		if (is_ok_result($api_result)) {
			$this->generate_cat_kw();
			$api_result['data'] = base_url('adminhouse/rent_index').'?cat='.$this->cat.'&kw='.$this->kw;
		}
		echo json_encode($api_result);
	}

	public function rent_image() {
		$this->check_state_api('POST');

		$uid = get_session_uid();
		$hid = $this->check_param_api('hid');

		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->update_rent_image($uid, $hid);
		echo json_encode($api_result);
	}

	public function del_rent_image() {
		$this->check_state_api('POST');
		$uid = get_session_uid();
		$hid = $this->check_param_api('hid');
		$image = $this->check_param_api('image');
		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->del_rent_image($uid, $hid, $image);
		echo json_encode($api_result);
	}

}

?>