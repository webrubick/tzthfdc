<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 小区
 */
class community_model extends MY_Model {
	
	// 表名
	const TABLE_NAME = 'tab_community';

	private $COLS = array(
		'cid', 'cname', 'pinyin'
	);
	private $INSERT_COLS = array(
		'cname', 'pinyin'
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
	 * 根据小区名获取小区信息
	 *
	 * @param	string	$cname 用户名
	 * @return	array 	$cname指定的小区信息
	 * @see CI_DB_result::result_array
	 */
	public function get_by_name($cname) {
		$this->setTable($this::TABLE_NAME);
		$this->db->select($this->COLS);
		$cname = $this->db->escape($cname);
		return $this->getSingle(array('cname'=>$cname));	
	}

	/**
	 * 根据小区名判断是否存在
	 *
	 * @param	string	$cname 小区名
	 * @return	bool 	是否存在该小区
	 * @see empty(CI_DB_result::result_array)
	 */
	public function exist_by_name($cname) {
		$this->setTable($this::TABLE_NAME);
		$result = $this->get_by_name($cname);
		return !empty($result);
	}

	/**
	 * 增加小区
	 *
	 * @param	user	$cname 小区名
	 * @return	true or false 
	 * @see CI_DB_result::insert  db->insert_id()
	 */
	public function add($cnames) {
		$this->setTable($this::TABLE_NAME);
		
		if (is_array($cnames)) {
			$insertData = array();
			foreach ($cnames as $cname) {
				$cname = $this->db->escape($cname);
				array_push($insertData, array('cname' => $cname));
			}
			$result = $this->addBatchData($insertData);
			return $result !== FALSE;
		} else {
			$cnames = $this->db->escape($cnames);
			$result = $this->addData(array('cname' => $cnames));
			return isset($result);	
		}
	}

	/**
	 * 修改小区名
	 *
	 * @return	bool	TRUE on success, FALSE on failure
	 * @see CI_DB_query_builder::update
	 */
	public function update_by_id($cid, $cname) {
		$this->setTable($this::TABLE_NAME);
		$cname = $this->db->escape($cname);
		return $this->editData(array('cid' => $cid), array('cname' => $cname));
	}

	/**
	 * 删除小区
	 *
	 * @param	string	$cid 小区ID
	 * @return	bool	TRUE on success, FALSE on failure
	 * @see CI_DB_query_builder::delete
	 */
	public function del_by_id($cid) {
		$result = $this->delData($cid, $this::TABLE_NAME, 'cid');
		return $result === FALSE ? FALSE : TRUE;
	}

	/**
	 * 删除所有小区
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