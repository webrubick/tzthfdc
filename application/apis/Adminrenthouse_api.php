<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 房源相关的API
 */
class Adminrenthouse_api extends API {

	protected $apicode = array(
		11001 => '未选择小区',
		11002 => '标题为空',
		11003 => '未指定户型',
		11004 => '未指定面积',
		11005 => '未指定价格',
		11006 => '新增出租房源失败',

		11007 => '未指定操作用户',
		11008 => '未指定删除的房源',
		11009 => '删除房源失败',

		11010 => '未指定更新的房源',
		11011 => '更新房源失败',


		11012 => '未指定出租方式',
		11013 => '未指定缴纳租金方式',
		11014 => '房源图片更新失败',
		11015 => '房源图片保存失败',
		11016 => '联系人为空',
		11017 => '联系方式为空',
		
		11100 => '',
	);

	public function __construct() {
		parent::__construct();

		$this->load->model('renthouse_model');
	}

	// **************************************************
	// **************************************************
	// rent house
	// **************************************************
	public function rent_item($uid, $hid) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(11007); }

		$rent_house = $this->renthouse_model->get_by_hid_by_uid($uid, $hid);
		return $this->ok($rent_house);
	}

	public function rent_list($uid, $kw = NULL) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(11007); }

		$rent_houses = $this->renthouse_model->get_by_kw_by_uid($uid, $kw);
		return $this->ok($rent_houses);
	}

	public function add_rent($uid, $house, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10007); }

		$code = $this->validateAddRent($house);
		if ($code != 200) { return $this->ex($code); }

		isset($house['uid']) OR $house['uid'] = $uid;

		$insert_result = $this->renthouse_model->add($house);
		if (!$insert_result) {
			log_message('error', 'add_rent db failed');
			return $this->ex(11006);
		}
		
		if ($return_list) { return $this->rent_list(); }

		return $this->ok($insert_result);
	}

	public function update_rent($uid, $hid, $house, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(11007); }
		if (!isset($hid)) { return $this->ex(11010); }

		if (isset($house) && !empty($house)) {
			isset($house['uid']) OR $house['uid'] = $uid;
			$update_result = $this->renthouse_model->update_by_hid($hid, $house);
			if (!$update_result) {
				log_message('error', 'update_rent db failed');
				return $this->ex(11011);
			}
		}
		
		if ($return_list) { return $this->sell_list(); }

		return $this->ok();
	}

	public function del_rent($uid, $hid, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(11007); }
		if (!isset($hid) || empty($hid)) { return $this->ex(11008); }

		$del_result = $this->renthouse_model->del_by_hid($hid);
		if (!$del_result) {
			log_message('error', 'del_rent db failed');
			return $this->ex(11009);
		}
		
		if ($return_list) { return $this->sell_list(); }

		return $this->ok();
	}

	// 新增房源验证必要的字段
	private function validateAddRent($house) {
		if (!isset($house['cid']) && !isset($house['community'])) {
			return 11001;
		}
		if (!isset($house['title']) || empty($house['title'])) {
			return 11002;
		}
		if (!isset($house['rooms'])) {
			return 11003;
		}
		if (!isset($house['size'])) {
			return 11004;
		}
		if (!isset($house['price'])) {
			return 11005;
		}
		if (!isset($house['rent_type'])) {
			return 11012;
		}
		if (!isset($house['rentpay_type'])) {
			return 11013;
		}
		if (!isset($house['poster_name']) || empty($house['poster_name'])) {
			return 11016;
		}
		if (!isset($house['poster_contact']) || empty($house['poster_contact'])) {
			return 11017;
		}
		return 200;
	}
	
	public function update_rent_image($uid, $hid) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10012); }

		$rent_house = $this->renthouse_model->get_by_hid_by_uid($uid, $hid);
		if (!isset($rent_house) || empty($rent_house)) {
			return $this->ex(11013);
		}

		$this->load->helper('upload');
		$save_result = save_house_image($this, $uid, $hid, 'rent');

		if (is_ok_result($save_result)) {
			$images = $save_result['data']; // 新的头像地址
			$update_result = $this->renthouse_model->update_by_hid($hid, array('images' => $images));
			if (!$update_result) {
				log_message('error', 'update_rent_image db failed');
				// 删除文件，因为并没有更新成功
				delete_house_image($images);
				return $this->ex(11014);
			} else {
				delete_old_house_image($this, $rent_house['images'], $images); // 删除老的头像文件
				$rent_house['images'] = $images;
				return $this->ok($rent_house);
			}
		} else {
			return $this->ex(11015);
		}
	}
	
	
	
	
	
	// ====================================
    // 专门为个人
    public function add_rent_other($house, $return_list = FALSE) {
		$code = $this->validateAddRent($house);
		if ($code != 200) { return $this->ex($code); }
		$insert_result = $this->renthouse_model->add($house);
		if (!$insert_result) {
			log_message('error', 'add_rent db failed');
			return $this->ex(11006);
		}
		
		if ($return_list) { return $this->rent_list(); }
		return $this->ok($insert_result);
	}

	public function update_rent_image_other($hid) {
		$rent_house = $this->renthouse_model->get_by_hid($hid);
		if (!isset($rent_house) || empty($rent_house)) {
			return $this->ex(11013);
		}

		$this->load->helper('upload');
		$save_result = save_house_image($this, 'tmp', $hid, 'rent');

		if (is_ok_result($save_result)) {
			$images = $save_result['data']; // 新的头像地址
			$update_result = $this->renthouse_model->update_by_hid($hid, array('images' => $images));
			if (!$update_result) {
				log_message('error', 'update_rent_image db failed');
				// 删除文件，因为并没有更新成功
				delete_house_image($images);
				return $this->ex(11014);
			} else {
				delete_old_house_image($this, $rent_house['images'], $images); // 删除老的头像文件
				$rent_house['images'] = $images;
				return $this->ok($rent_house);
			}
		} else {
			return $this->ex(11015);
		}
	}

}


?>