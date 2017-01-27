<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;
use Route, Auth;

final class Helper {
	private $styles = array();
	private $scripts = array();

	private $heading_title;

	public function addStyle($href, $rel = 'stylesheet', $media = 'screen') {
		if(is_array($href)){
			foreach($href as $hr){
				$this->styles[$hr] = array(
					'href'  => $hr,
					'rel'   => $rel,
					'media' => $media
				);
			}
		} else {
			$this->styles[$href] = array(
				'href'  => $href,
				'rel'   => $rel,
				'media' => $media
			);
		}
	}

	public function addScript($href) {
		if(is_array($href)){
			foreach($href as $hr){
				$this->scripts[$hr] = array(
					'href'  => $hr
				);
			}
		} else {
			$this->scripts[] = array(
				'href'  => $href
			);
		}
	}

	public function getStyles(){
		return $this->styles;
	}

	public function getScripts() {
		return $this->scripts;
	}

	public function getBodyClass(){
		$body_class = '';
		$route = Route::getCurrentRoute()->getName();
		if($route == 'admin.login'){
			$body_class = 'login-page';
		} else {
			$body_class = 'skin-blue sidebar-mini';
		}
		return $body_class;
	}

	public function setTitle($title){
		$this->heading_title = isset($title) ? $title : 'PenCMS';
	}

	public function getTitle(){
		return $this->heading_title;
	}

	/* UTF-8 helper */
	public function utf8_substr($string, $offset, $length = null) {
		if ($length === null) {
			return mb_substr($string, $offset, $this->utf8_strlen($string));
		} else {
			return mb_substr($string, $offset, $length);
		}
	}

	public function utf8_strlen($string) {
		return iconv_strlen($string, 'UTF-8');
	}

	public function utf8_strrpos($string, $needle, $offset = 0) {
		return mb_strrpos($string, $needle, $offset);
	}
}
?>