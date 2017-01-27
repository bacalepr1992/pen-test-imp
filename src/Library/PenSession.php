<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;
use Session;

final class PenSession {
	public $data = array();

	public function __construct(){
		$this->merge();
	}

	public function flash($key, $data = ''){
		Session::flash($key, $data);
	}

	public function get($key){
		return isset($this->data[$key]) ? $this->data[$key] : '';
	}

	public function all(){
		return $this->data;
	}

	private function merge(){
		$this->data = array(
			'success' => Session::has('success') ? Session::get('success') : '',
			'warning' => Session::has('warning') ? Session::get('warning') : '',
			'error'   => Session::has('error') ? Session::get('error') : '',
		);
	}
}
?>