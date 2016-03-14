<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// api基类，API是一种特殊的controller
/**
 * 用来验证
 */
class API {

	protected $common_apicode = array(
	    200   => 'OK',
	    400   => 'HTTP请求方式错误',
		90000 => '用户未登录'
	);
	
	private $all_codes;
	
	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct() {
		// do sth. common
		
		$this->all_codes = $this->common_apicode;
		if (isset($this->apicode)) {
    		$this->all_codes = array_merge_y($this->common_apicode, $this->apicode);
		}
	}
	
	public function check_base($validates = array(), $data = NULL, $desired_method = 'POST') {
	    $cur_req_method = $this->input->method(TRUE);
		$desired_method = strtoupper($desired_method);
		if ($cur_req_method != $desired_method) {
			return 400;
		}
		return $this->check_param($validates, $data);
	}
	
	/**
	 * 检测参数
	 * 
	 * return 一旦没有找到相应的参数，返回error code；否则，返回0
	 */ 
	public function check_param($validates = array(), $data = NULL) {
	    if (empty($validates) || empty($data)) {
	        return 0;
	    }
	    foreach ($validates as $key => $value) {
	        if (!array_key_exists($key, $data)) {
	            return $value;
	        }
	    }
	    return 0;
	}
	
	public function check_get($key, $data = NULL, $def_val = NULL) {
	    if (empty($key) || empty($data)) {
	        return $def_val;
	    }
	    return $data[$key];
	}
	
	
	/**
	 * 需要登录状态的API通过此方法判断是否已经登录；
	 * 
	 * 如果没有登录，返回封装好的错误数据；
	 *
	 * 否则，返回FALSE
	 *
	 */
	public function un_login() {
		// 如果没有登录
		return $this->ex(90000);
	}

	/**
	 * 不正确/非正常的API返回结果，形如：
	 * 
	 * {'code':10001, 'msg':'xxx err', 'data':null}
	 *
	 * @return	array
	 */
	public function ex($code, $data = NULL) {
		if (isset($this->all_codes[$code])) {
			return common_result($code, $this->all_codes[$code], $data);
		}
		return common_result($code, '未定义的错误码' . $code, $data);
	}

	/**
	 * 正确的API返回结果，形如：
	 * 
	 * {'code':200, 'msg':'success', 'data':null}
	 *
	 * @return	array
	 */
	public function ok($data = NULL) {
		return common_result_ok($data);
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows models to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Model.php', it's
		//	most likely a typo in your model code.
		return get_instance()->$key;
	}

}

?>