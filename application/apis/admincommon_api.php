<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 公共信息相关的API
 */
class admincommon_api extends API {

	protected $apicode = array(
		80001 => '请输入小区名',
		80002 => '添加小区失败',
		80003 => '更新小区失败',
		80004 => '未指定更新的小区',
		80005 => '未指定删除的小区',
		80006 => '删除小区失败',

		80101 => '请输入区域名',
		80102 => '添加区域失败',
		80103 => '更新区域失败',
		80104 => '未指定更新的区域',
		80105 => '未指定删除的区域',
		80106 => '删除区域失败'

	);

	public function __construct() {
		parent::__construct();
		$this->load->model('user_model');
	}

	public function community_list() {
		$this->load->model('community_model');
		$communitys = $this->community_model->get_all();
		return $this->ok($communitys);
	}

	// 添加成功后返回最新的列表
	public function community_add($cnames, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($cnames) || empty($cnames)) { return $this->ex(80001); }

		$this->load->model('community_model');
		$result = $this->community_model->add($cnames);
		if (!$result) {
			log_message('error', 'community_add db failed');
			return $this->ex(80002);
		}
		if ($return_list) {
			return $this->community_list();
		}
		return $this->ok();
	}

	public function community_edit($cid, $cname, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($cid) || empty($cid)) { return $this->ex(80004); }
		if (!isset($cname) || empty($cname)) { return $this->ex(80001); }

		$this->load->model('community_model');
		$result = $this->community_model->update_by_id($cid, $cname);
		if (!$result) {
			log_message('error', 'community_edit db failed');
			return $this->ex(80003);
		}
		if ($return_list) {
			return $this->community_list();
		}
		return $this->ok();
	}

	public function community_del($cid, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($cid) || empty($cid)) { return $this->ex(80005); }

		$this->load->model('community_model');
		$result = $this->community_model->del_by_id($cid);
		if (!$result) {
			log_message('error', 'community_del db failed');
			return $this->ex(80006);
		}
		if ($return_list) {
			return $this->community_list();
		}
		return $this->ok();
	}


	public function area_list() {
		$this->load->model('area_model');
		$areas = $this->area_model->get_all();
		return $this->ok($areas);
	}

	public function area_add($area_names, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($area_names) || empty($area_names)) { return $this->ex(80101); }

		$this->load->model('area_model');
		$result = $this->area_model->add($area_names);
		if (!$result) {
			log_message('error', 'area_add db failed');
			return $this->ex(80102);
		}
		if ($return_list) {
			return $this->area_list();
		}
		return $this->ok();
	}

	public function area_edit($aid, $area_name, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($aid) || empty($aid)) { return $this->ex(80104); }
		if (!isset($area_name) || empty($area_name)) { return $this->ex(80101); }

		$this->load->model('area_model');
		$result = $this->area_model->update_by_id($aid, $area_name);
		if (!$result) {
			log_message('error', 'area_edit db failed');
			return $this->ex(80103);
		}
		if ($return_list) {
			return $this->area_list();
		}
		return $this->ok();
	}

	public function area_del($aid, $return_list = FALSE) {
		if (!is_login()) { return $this->un_login(); }

		if (!isset($aid) || empty($aid)) { return $this->ex(80105); }

		$this->load->model('area_model');
		$result = $this->area_model->del_by_id($aid);
		if (!$result) {
			log_message('error', 'area_del db failed');
			return $this->ex(80106);
		}
		if ($return_list) {
			return $this->area_list();
		}
		return $this->ok();
	}

}


?>