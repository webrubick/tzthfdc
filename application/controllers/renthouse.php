<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class renthouse extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('house');
		$this->load->helper('houseparse');
	}

	public function index($hid = NULL) {
		if (isset($hid)) {
			$this->rent_item($hid);
		} else {
			$this->rent_list();
		}
	}

	private function rent_list() {
		// 分类信息
		$this->cat = HOUSE_CAT_RENT;

		// 前端检索的关键词
		$this->filters = array(
			'area' => 0,
			'size' => 0,
			'room' => 0,
			'price' => 0,
			'decor' => 0,
			'floor_from' => 0,
			'floor_to' => 0,
			'community' => 0,
		);

		// 从请求参数列表中解析出需要的字段
		$filter_keys = array_keys($this->filters);
		foreach ($filter_keys as $key) {
			$val = $this->input->get_post($key, TRUE);
			if (isset($val) && !empty($val)) {
				$this->filters[$key] = $val;
			}
		}
		// print_r($this->filters);

		loadRentFilterInfos($this);

		// 转为数据库查询条件
		$filter_conditions = filter_to_rent_conditions($this, $this->filters);
		// print_r($filter_conditions);

		// 搜索参数
		$kw = $this->input->get_post('kw', TRUE);

		// 分页相关的参数
		$page_size = HOUSE_LIST_PAGE_SIZE;
		$currentpage = intval($this->input->get_post('currentpage', TRUE));
		// print_r($currentpage);
		if (!isset($currentpage) || $currentpage <= 0) {
			$currentpage = 1;
		}
		// print_r($currentpage);
		$offset = max(0, $currentpage - 1) * $page_size;

		$this->load->model('renthouse_model');
		$total = $this->renthouse_model->num_rows($kw, $filter_conditions);

		$this->pagearr = array(
			'currentpage' => $currentpage,
			'totalnum' => $total,
			'pagesize' => $page_size,
			'pagenum' => ceil($total / $page_size),
		);

		$result_num = 0;
		if ($total > 0) {
			// 组装成界面需要的格式
			// 查询
			$renthouses = $this->renthouse_model->get_page_data($page_size, $offset, $kw, $filter_conditions);
			if (isset($renthouses) && !empty($renthouses)) {
				$parsed_houses = array();
				// 处理数据
				foreach ($renthouses as $house) {
					$parsed_houses[] = parse_rent_list_item($this, $house);
				}
				$this->houses = $parsed_houses;
				// print_r($this->houses);
				$result_num = count($this->houses);
			}
		}
		unloadRentCommonInfos($this);

		$this->kw = $kw;
		$this->result_num = $total;

		$this->load->view('portal/house-list', $this);
	}

	private function rent_item($hid) {
		if (!isset($hid)) {
			ishow_404('请指定房源');
		}

		$this->load->model('renthouse_model');
		$renthouse = $this->renthouse_model->get_single_by_hid($hid);
		if (!isset($renthouse) || empty($renthouse)) {
			ishow_404('找不到房源');
		}

		$this->cat = HOUSE_CAT_RENT;
		loadRentCommonInfos($this);
		$this->house = parse_rent_house_item($this, $renthouse);
		unloadRentCommonInfos($this);
		
		// print_r($this->house);
		$this->load->view('portal/rent-info', $this);
	}
}

?>