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
		$this->load->helper('house');
	}

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

}

?>