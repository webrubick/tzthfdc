<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load_sessionaccess();
	}

	public function index() {
	    $this->kw = '';
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
		$this->load->helper('house');
		$this->load->helper('houseparse');
		
		$this->load->model('renthouse_model');
		$renthouses = $this->renthouse_model->get_page_data(HOT_HOUSE_NUM);
		loadRentFilterInfos($this);
		if (isset($renthouses) && !empty($renthouses)) {
			$parsed_houses = array();
			// 处理数据
			foreach ($renthouses as $house) {
				$parsed_houses[] = parse_hot_rent_list_item($this, $house);
			}
			$this->renthouses = $parsed_houses;
		}
		
		$this->load->model('sellhouse_model');
		$this->result_num = $this->sellhouse_model->num_rows();
		loadSellFilterInfos($this);
		if ($this->result_num > 0) {
		    $sellhouses = $this->sellhouse_model->get_page_data(HOT_HOUSE_NUM);
			if (isset($sellhouses) && !empty($sellhouses)) {
				$parsed_houses = array();
				// 处理数据
				foreach ($sellhouses as $house) {
					$parsed_houses[] = parse_hot_sell_list_item($this, $house);
				}
				$this->sellhouses = $parsed_houses;
			}
		}
		unloadCommonInfos($this);
		
		$this->load->view('portal/index', $this);
	}

}

?>