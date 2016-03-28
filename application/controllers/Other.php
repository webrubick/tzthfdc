<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 个人房源
 * 
 * 个人房源可以认为是临时用户
 * 
 */
class Other extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load_sessionaccess();
		$this->load->helper('house');
	}
	
	// >>>>>>>>>>>>>>>>>>>>>>>
	// 游客方式
    public function addsell() {
        loadCommonInfos($this);
        $this->load->view('portal/other/addsell', $this);
    }
    
    public function addsell_ajax() {
        $this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->add_sell_other($post);
		if (is_ok_result($api_result)) {
			$hid = $api_result['data'];
			$api_result['data'] = array(
				'url' => base_url('sellhouse/' . $hid),
				'hid' => $hid
			);
		}
		echo json_encode($api_result);
    }
    
    public function sell_image() {
		$this->check_state_api('POST');
		$hid = $this->check_param_api('hid');
		$this->load->api('adminsellhouse_api');
		$api_result = $this->adminsellhouse_api->update_sell_image_other($hid);
		echo json_encode($api_result);
    }




    public function addrent() {
		loadRentCommonInfos($this);
        $this->load->view('portal/other/addrent', $this);
    }
    
    public function addrent_ajax() {
        $this->check_state_api('POST');
		// 获取所有的数据
		$post = $this->input->post(NULL,TRUE);

		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->add_rent_other($post);
		if (is_ok_result($api_result)) {
			$hid = $api_result['data'];
			$api_result['data'] = array(
				'url' => base_url('renthouse/' . $hid),
				'hid' => $hid
			);
		}
		echo json_encode($api_result);
    }
    
    public function rent_image() {
		$this->check_state_api('POST');
		$hid = $this->check_param_api('hid');
		$this->load->api('adminrenthouse_api');
		$api_result = $this->adminrenthouse_api->update_rent_image_other($hid);
		echo json_encode($api_result);
    }
    // end 游客方式
    
    
    
    // >>>>>>>>>>>>>>>>>>>>>>>>>>
    // 个人用户
    public function adminhouse() {
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
        $this->load->view('portal/other/adminhouse', $this);
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

}

?>