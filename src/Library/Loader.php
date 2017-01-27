<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;
use App;
use \PenFramework\Controller\ErrorController;

class Loader {
	private $url;
	private $config;
	private $prefix;

	public function __construct(){
		$this->url = app('pen_url');
		$this->config = app('pen_config');
		$this->prefix = $this->url->getPrefix();
	}

	public function controller($route, $data = array()) {

		if(isset($route) && !empty($route)){
			$method = 'index';

    	$file = '';
    	$parts = explode('/', preg_replace('/[^a-zA-Z0-9_\/]/', '', (string)$route));

			// Break apart the route
			while ($parts) {
				$file = DIR_CONTROLLER . $this->prefix . '/' . implode('/', $parts) . '.php';

				// $core_file =
				if (is_file($file)) {
					$route = implode('/', str_replace('_','' , $parts));
					break;
				} else {
					$method = array_pop($parts);
				}
			}

    	if (file_exists($file)) {
    		$class = str_replace('/','\\' , $route);

    		include_once($file);
    		$controllerClass = 'App\PenCMS\Controllers\\' . $this->prefix . '\\' . $class  . 'Controller';
    		$controllerObj = App::make($controllerClass);

      	if(method_exists($controllerObj, $method)){
      		return $controllerObj->$method($data);
      	}
      } else {
      	$error404 = new ErrorController();
      	return $error404->error404();
      }
		}
	}

	public function model($route) {
		if(isset($route) && !empty($route)){
			$file  = DIR_MODEL . $this->prefix . '/' . $route . '.php';

			if (file_exists($file)) {
				$route = explode('/', $route);

				$folder = isset($route[0]) ? $route[0] : '';
      	$model = isset($route[1]) ? $route[1] : '';
				include_once($file);
				$modelClass = 'App\PenCMS\Models\\' . $this->prefix . '\\' . $folder .'\\'. str_replace('_', '', (string)$model);

    		$modelObj = App::make($modelClass);

    		return $modelObj;
			} else {
				throw new \Exception('Error: Could not load model ' . $route . '!');
			}
		}
	}

	public function view($route, $data = array()){

		if($this->prefix == 'admin'){
			$template = $this->config->get('config_admin_template');
		} elseif($this->prefix == 'front'){
			$template = $this->config->get('config_front_template');
		}

		// $file  = base_path() . '/resources/views/' . $this->prefix . '/' . $template . '/' .  $route . '.blade.php';
		$file = DIR_TEMPLATE . $this->prefix . '/' . $template . '/' .  $route . '.blade.php';
		if(file_exists($file)){
			$template = $this->prefix .'/'. $template .'/'. $route;
			return view($template, $data);
		} else {
			throw new \Exception('Error: Could not load view ' . $route . '!');
		}
	}


}