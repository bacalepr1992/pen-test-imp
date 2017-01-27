<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Controller;

use Illuminate\Routing\Controller as BaseController;
use PenFramework\Library\Helper;
use PenFramework\Library\Loader;
use PenFramework\Library\Url;
use PenFramework\Controller\ErrorController;
use Auth, App, Session, Log;

class AdminController extends BaseController {

	protected $helper, // PenHelper
	 					$load, // PenLoader
	 					$url, // PenUrl
	 					$request, // PenRequest
	 					$permission, // PenPermission
						$language, // PenLanguage
						$user, // User
						$session, // PenSession
						$pagination, // flash_messages
						$config, // PenConfig
						$validate, // Validator
						$log; // Validator

	public function __construct(){
		$this->helper     = app('pen_helper');
		$this->load       = app('pen_loader');
		$this->url        = app('pen_url');
		$this->request    = app('pen_request');
		$this->permission = app('pen_permission');
		$this->language   = app('pen_language');
		$this->session    = app('pen_session');
		$this->pagination = new \PenFramework\Library\Pagination;
		$this->config     = app('pen_config');
		$this->user       = Auth::user();
		$this->validate   = app('pen_validate');
		$this->log   = new \PenFramework\Library\Logger;
	}

	public function run($route) {
		if(isset($route) && !empty($route)){
			return $this->load->controller($route);
		} else {
			$error404 = new ErrorController();
    	return $error404->index();
		}
	}

	public function getAllModules(){
		$modules = array();
    $list_modules = array_map('basename', \File::directories(DIR_MODULE));
    foreach ($list_modules as $module) {
    	if(file_exists(DIR_MODULE.'/'.$module.'/module.json')) {
        $json = file_get_contents(DIR_MODULE.'/'.$module.'/module.json');
        $detail = json_decode($json, true);

        $modules[] = array(
        	'name' => isset($detail['name']) ? $detail['name'] : '',
        	'description' => isset($detail['description']) ? $detail['description'] : '',
        	'version' => isset($detail['version']) ? $detail['version'] : '',
        	'author' => $detail['author'],
        	'edit' => $this->url->link('module/'.$module)
        );
    	}
    }
    return $modules;
	}

	public function getAllThemes(){
		$themes = array();
    $list_themes = array_map('basename', \File::directories(DIR_TEMPLATE));
    foreach ($list_themes as $theme) {
      $themes[] = array(
      	'name' => $theme,
      );
    }
    return $themes;
	}
}
?>