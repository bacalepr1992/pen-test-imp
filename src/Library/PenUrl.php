<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;
use Illuminate\Support\Facades\Route;

final class PenUrl {
	public $prefix;
	public $locale;

	public function __construct(){
		$this->__prefix();
		$this->locale = app()->getLocale();
	}

	public function link($route, $request = '') {
		$url = url($this->locale . '/' . $this->prefix . '/' . $route);
		if(!empty($request)){
			if (is_array($request)) {
				$url .= '&#63;' . http_build_query($request);
			} else {
				$url .= str_replace('?', '&#63;', '?' . ltrim($request, '?'));
			}
		}
		return $url;
	}

	public function getLocale(){
		return $this->locale;
	}

	public function getPrefix(){
		return $this->prefix;
	}

	public function setUrl($route = ''){
		return url($route);
	}

	private function __prefix(){
		$prefix = \Route::getCurrentRoute()->getPrefix();
		// $prefix = \Request::path();
		$prefix = explode('/', $prefix);
		$this->prefix = $prefix[1];
	}
}
?>