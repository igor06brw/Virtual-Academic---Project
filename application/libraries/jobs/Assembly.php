<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Assembly{
	
	public $CI;
	
	public function __construct(){
		$this->CI = &get_instance();
	}
	
	public function getData(){
		$data = array(
		'test' => 33
		);
		return $data;
	}
	
}