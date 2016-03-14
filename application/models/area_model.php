<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 区域
 */
class area_model extends MY_Model {
	
	// 表名
	const TABLE_NAME = 'tab_area';

	private $COLS = array(
		'aid', 'area_name'
	);
	private $INSERT_COLS = array(
		'area_name'
	);
	
	public function __construct() {
		parent::__construct();
	}

	public function get_all() {
		$this->setTable($this::TABLE_NAME);
		$this->db->select($this->COLS);
		return $this->getData();
	}

	/**
	 * 根据区域名获取区域信息
	 *
	 * @param	string	$area_name 用户名
	 * @return	array 	$area_name指定的区域信息
	 * @see CI_DB_result::result_array
	 */
	public function get_by_name($area_name) {
		$this->setTable($this::TABLE_NAME);
		$this->db->select($this->COLS);
		$area_name = $this->db->escape($area_name);
		return $this->getSingle(array('area_name'=>$area_name));	
	}

	/**
	 * 根据区域名判断是否存在
	 *
	 * @param	string	$area_name 区域名
	 * @return	bool 	是否存在该区域
	 * @see empty(CI_DB_result::result_array)
	 */
	public function exist_by_name($area_name) {
		$this->setTable($this::TABLE_NAME);
		$result = $this->get_by_name($area_name);
		return !empty($result);
	}

	/**
	 * 增加区域
	 *
	 * @param	user	$area_name 区域名
	 * @return	insert_id or false 
	 * @see CI_DB_result::insert  db->insert_id()
	 */
	public function add($area_names) {
		$this->setTable($this::TABLE_NAME);
		
		if (is_array($area_names)) {
			$insertData = array();
			foreach ($area_names as $area_name) {
				$area_name = $this->db->escape($area_name);
				array_push($insertData, array('area_name' => $area_name));
			}
			$result = $this->addBatchData($insertData);
			return $result !== FALSE;
		} else {
			$area_names = $this->db->escape($area_names);
			$result = $this->addData(array('area_name' => $area_names));
			return isset($result);	
		}
	}

	/**
	 * 修改区域名
	 *
	 * @return	bool	TRUE on success, FALSE on failure
	 * @see CI_DB_query_builder::update
	 */
	public function update_by_id($aid, $area_name) {
		$this->setTable($this::TABLE_NAME);
		$area_name = $this->db->escape($area_name);
		return $this->editData(array('aid' => $aid), array('area_name' => $area_name));
	}

	/**
	 * 删除区域
	 *
	 * @param	string	$aid 区域ID
	 * @return	bool	TRUE on success, FALSE on failure
	 * @see CI_DB_query_builder::delete
	 */
	public function del_by_id($aid) {
		$result = $this->delData($aid, $this::TABLE_NAME, 'aid');
		return $result === FALSE ? FALSE : TRUE;
	}

	/**
	 * 删除所有区域
	 *
	 * @return	bool	TRUE on success, FALSE on failure
	 * @see CI_DB_query_builder::delete
	 */
	public function del_all() {
		$result = $this->delAll($this::TABLE_NAME);
		return $result === FALSE ? FALSE : TRUE;
	}
	
}

?>