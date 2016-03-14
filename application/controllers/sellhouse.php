<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class sellhouse extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('house');
		$this->load->helper('houseparse');
	}

	public function index($hid = NULL) {
		if (isset($hid)) {
			$this->sell_item($hid);
		} else {
			$this->sell_list();
		}
	}

	private function sell_list() {
		// 分类信息
		$this->cat = HOUSE_CAT_SELL;

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

		loadSellFilterInfos($this);

		// 转为数据库查询条件
		$filter_conditions = filter_to_sell_conditions($this, $this->filters);
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

		$this->load->model('sellhouse_model');
		$total = $this->sellhouse_model->num_rows($kw, $filter_conditions);

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
			$sellhouses = $this->sellhouse_model->get_page_data($page_size, $offset, $kw, $filter_conditions);
			if (isset($sellhouses) && !empty($sellhouses)) {
				$parsed_houses = array();
				// 处理数据
				foreach ($sellhouses as $house) {
					$parsed_houses[] = parse_sell_list_item($this, $house);
				}
				$this->houses = $parsed_houses;
				// print_r($this->houses);
				$result_num = count($this->houses);
			}
		}
		unloadCommonInfos($this);

		$this->kw = $kw;
		$this->result_num = $total;

		$this->load->view('portal/house-list', $this);
	}

	private function sell_item($hid) {
		if (!isset($hid) || !is_numeric($hid)) {
			ishow_404('请指定房源');
		}

		$this->load->model('sellhouse_model');
		$sellhouse = $this->sellhouse_model->get_single_by_hid($hid);
		if (!isset($sellhouse) || empty($sellhouse)) {
			ishow_404('找不到房源');
		}

		$this->cat = HOUSE_CAT_SELL;
		loadCommonInfos($this);
		$this->house = parse_sell_house_item($this, $sellhouse);
		unloadCommonInfos($this);

		// print_r($this->house);
		$this->load->view('portal/sell-info', $this);
	}
}

?>