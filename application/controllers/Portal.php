<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portal extends MY_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load_sessionaccess();
	}

	public function index() {
		redirect(base_url('sellhouse'));
	}

}

?>