<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;
use DB;

class PenConfig {
	private $data = array();

	public function __construct(){
		$this->__setData();
	}

	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : null);
	}

	public function load($filename) {
		$file = $filename . '.php';

		if (file_exists($file)) {
			$_ = array();

			require($file);

			$this->data = array_merge($this->data, $_);
		} else {
			trigger_error('Error: Could not load config ' . $filename . '!');
			exit();
		}
	}

	private function __setData(){
		$results = DB::table('setting')->get();
		foreach($results as $result)
			$this->data[$result->key] = $result->value;
	}
}