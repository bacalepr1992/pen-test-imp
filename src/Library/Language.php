<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;

class Language {
	private $directory;
	public $data = array();

	public function __construct($directory = '') {
		$this->directory = $directory;
		$this->url = app('pen_url');

		$this->load($this->url->getLocale());
	}

	public function get($key) {
		return (isset($this->data[$key]) ? $this->data[$key] : $key);
	}

	public function set($key, $value) {
		$this->data[$key] = $value;
	}

	public function load($route) {
		if(isset($route) && !empty($route)){
			$file  = DIR_LANGUAGE . $this->url->locale .'/'. $this->url->prefix .'/'. $route . '.php';
			if (file_exists($file)) {
				$data = require($file);
 				$this->data = array_merge($this->data, $data);

				return $this->data;
			} else {
				throw new \Exception('Error: Could not load language ' .$this->url->prefix .'/'. $route . '!');
			}
		}
	}
}
