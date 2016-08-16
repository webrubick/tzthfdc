<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 房源相关的API
 */
class Adminsellhouse_api extends API {

	protected $apicode = array(
		10001 => '未选择小区',
		10002 => '标题为空',
		10003 => '未指定户型',
		10004 => '未指定面积',
		10005 => '未指定总价',
		10006 => '新增出售房源失败',

		10007 => '未指定操作用户',
		10008 => '未指定删除的房源',
		10009 => '删除房源失败',

		10010 => '未指定更新的房源',
		10011 => '更新房源失败',

		10012 => '未指定上传图片用户',
		10013 => '不知名的房源',
		10014 => '房源图片更新失败',
		10015 => '房源图片保存失败',
		
		10016 => '联系人为空',
		10017 => '联系方式为空',

		10018 => '未指定操作用户',
		10019 => '未指定房源',
		10020 => '没有指定图片',
		10021 => '删除图片失败',

	);

	public function __construct() {
		parent::__construct();

		$this->load->model('sellhouse_model');
	}

	// **************************************************
	// **************************************************
	// sell house
	// **************************************************
	// **************************************************
	public function sell_item($uid, $hid) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10007); }

		$sell_house = $this->sellhouse_model->get_by_hid_by_uid($uid, $hid);
		return $this->ok($sell_house);
	}

	public function sell_list($uid, $kw = NULL) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10007); }

		$sell_houses = $this->sellhouse_model->get_by_kw_by_uid($uid, $kw);
		return $this->ok($sell_houses);
	}

	public function add_sell($uid, $house, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10007); }

		$code = $this->validateAddSell($house);
		if ($code != 200) { return $this->ex($code); }

		isset($house['uid']) OR $house['uid'] = $uid;

		$insert_result = $this->sellhouse_model->add($house);
		if (!$insert_result) {
			log_message('error', 'add_sell db failed');
			return $this->ex(10006);
		}
		
		if ($return_list) { return $this->sell_list(); }

		return $this->ok($insert_result);
	}

	public function update_sell($uid, $hid, $house, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10007); }
		if (!isset($hid)) { return $this->ex(10010); }

		if (isset($house) && !empty($house)) {
			isset($house['uid']) OR $house['uid'] = $uid;
			$update_result = $this->sellhouse_model->update_by_hid($hid, $house);
			if (!$update_result) {
				log_message('error', 'update_sell db failed');
				return $this->ex(10011);
			}
		}
		
		if ($return_list) { return $this->sell_list(); }

		return $this->ok($hid);
	}

	public function del_sell($uid, $hid, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10007); }
		if (!isset($hid) || empty($hid)) { return $this->ex(10008); }

		// 删除图片
		$this->del_all_sell_images($uid, $hid);
		$del_result = $this->sellhouse_model->del_by_hid($hid);
		if (!$del_result) {
			log_message('error', 'del_sell db failed');
			return $this->ex(10009);
		}
		
		if ($return_list) { return $this->sell_list(); }

		return $this->ok();
	}

	// 新增房源验证必要的字段
	private function validateAddSell($house) {
		if (!isset($house['cid']) && !isset($house['community'])) {
			return 10001;
		}
		if (!isset($house['title']) || empty($house['title'])) {
			return 10002;
		}
		if (!isset($house['rooms'])) {
			return 10003;
		}
		if (!isset($house['size'])) {
			return 10004;
		}
		if (!isset($house['price'])) {
			return 10005;
		}
		if (!isset($house['poster_name']) || empty($house['poster_name'])) {
			return 10016;
		}
		if (!isset($house['poster_contact']) || empty($house['poster_contact'])) {
			return 10017;
		}
		return 200;
	}

	public function update_sell_image($uid, $hid) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10012); }

		$sell_house = $this->sellhouse_model->get_by_hid_by_uid($uid, $hid);
		if (!isset($sell_house) || empty($sell_house)) {
			return $this->ex(10013);
		}

		$this->load->helper('upload');
		$save_result = save_house_image($this, $uid, $hid, 'sell');

		if (is_ok_result($save_result)) {
			$image = $save_result['data'];
			$images = $sell_house['images'];
			if (empty($images)) {
				$images = $image;
			} else {
				$images = $images . ',' . $image;
			}
			$update_result = $this->sellhouse_model->update_by_hid($hid, array('images' => $images));
			if (!$update_result) {
				log_message('error', 'update_sell_image db failed');
				// 删除文件，因为并没有更新成功
				delete_house_image($this, $image);
				return $this->ex(10014);
			} else {
				$sell_house['images'] = $images;
				return $this->ok($sell_house);
			}
		} else {
			return $this->ex(10015);
		}
	}

	public function del_sell_image($uid, $hid, $image) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($uid)) { return $this->ex(10018); }

		$sell_house = $this->sellhouse_model->get_by_hid_by_uid($uid, $hid);
		if (!isset($sell_house) || empty($sell_house)) {
			return $this->ex(10019);
		}
		$images = $sell_house['images'];
		if (empty($images)) {
			return $this->ex(10020);
		}
		$images = explode(',', $images);
		$idx = array_search($image, $images);
		if ($idx === FALSE) {
			return $this->ex(10020);
		}
		unset($images[$idx]);
		$images = implode(',', $images);
		$update_result = $this->sellhouse_model->update_by_hid($hid, array('images' => $images));
		if (!$update_result) {
			return $this->ex(10021);
		}
		$this->load->helper('upload');
		delete_house_image($this, $image);
		return $this->ok();
	}

	private function del_all_sell_images($uid, $hid) {
		$sell_house = $this->sellhouse_model->get_by_hid_by_uid($uid, $hid);
		if (!isset($sell_house) || empty($sell_house)) {
			return;
		}
		$images = $sell_house['images'];
		if (empty($images)) {
			return;
		}
		$images = explode(',', $images);
		$this->load->helper('upload');
		foreach ($images as $image) {
			delete_house_image($this, $image);
		}
	}





    // ====================================
    // 专门为个人
    public function add_sell_other($house, $return_list = FALSE) {
		$code = $this->validateAddSell($house);
		if ($code != 200) { return $this->ex($code); }
		$insert_result = $this->sellhouse_model->add($house);
		if (!$insert_result) {
			log_message('error', 'add_sell db failed');
			return $this->ex(10006);
		}
		
		if ($return_list) { return $this->sell_list(); }
		return $this->ok($insert_result);
	}

	public function update_sell_image_other($hid) {
		$sell_house = $this->sellhouse_model->get_by_hid($hid);
		if (!isset($sell_house) || empty($sell_house)) {
			return $this->ex(10013);
		}

		$this->load->helper('upload');
		$save_result = save_house_image($this, 'tmp', $hid, 'sell');

		if (is_ok_result($save_result)) {
			$image = $save_result['data'];
			$images = $sell_house['images'];
			if (empty($images)) {
				$images = $image;
			} else {
				$images = $images . ',' . $image;
			}
			$update_result = $this->sellhouse_model->update_by_hid($hid, array('images' => $images));
			if (!$update_result) {
				log_message('error', 'update_sell_image db failed');
				// 删除文件，因为并没有更新成功
				delete_house_image($this, $image);
				return $this->ex(10014);
			} else {
				$sell_house['images'] = $images;
				return $this->ok($sell_house);
			}
		} else {
			return $this->ex(10015);
		}
	}
    
}


?>