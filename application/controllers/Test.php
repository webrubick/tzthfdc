<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
	    echo json_encode(array(
	        'code' => 200,
	        'msg' => 'OK',
	        'data' => array(
	                'url' => 'http://www.baidu.com'
	            ),
	        ));
	    phpinfo();
	}
	
	public function test1(){
	    $data = array(
	        'a' => '1',
	        'b' => '2',
	        'c' => '3',
	        'd' => '4',
	    );
	    $keys = array(
	        'a', 
	        'c', 
	        'e'
	    );
	    print_r($this->check_params($keys, $data));
	    
	    
	    echo "<br/>";
	    
	    $this->test(function ($param) use ($data) {
	        echo($param);
	        print_r($data);
	    });
	}
	
	public function test($callback) {
	    $callback('1');
	}
	
	
	/**
	 * 检测单个参数
	 */
	public function check_param($key, $data = NULL) {
	    return $this->check_params(array($key), $data);
	}
	
	/**
	 * 检测参数
	 */
	public function check_params($keys = array(), $data = NULL) {
	    if (empty($keys) || empty($data)) {
	        return array();
	    }
	    $dummy_data = array_fill_keys($keys, NULL);
	    array_merge_by_key($data, $dummy_data, $keys);
	    return $dummy_data;
	}
	
}
