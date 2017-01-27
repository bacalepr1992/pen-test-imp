<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;
use DB, Session;

class Permission {

	private $permission;

	public function __construct(){
		/*foreach($permission as $key => $value){
			$this->permission[$key] = $value;
		}*/
	}

	public function check($permission, $route){
		$route = explode('/', $route);
		$route = array_slice($route, 0, 2);
		$route = implode('/', $route);

		if($permission && !empty($route)){
			if (in_array($route, $permission)) {
				return in_array($route, $permission);
			} else {
				return false;
			}
		}
	}

	public function hasPermission($key, $value) {
		if (isset($this->permission[$key])) {
			return in_array($value, $this->permission[$key]);
		} else {
			return false;
		}
	}

	public function getPermission($user_group_id){
		$permission = array();
		$result = DB::table('user_group')->select('permission')->where('user_group_id', $user_group_id)->first();
		if($result){
			$permission = json_decode($result->permission, true);
			$this->permission = $permission;
			return $permission;
		}
	}

	public function getAllController(){
		$files = array();
		$data_permissions = array();
		$ignore = array(
			'common/header',
			'common/footer'
		);

		$path = array(
			DIR_APP . 'Controllers/Admin/*'
		);

		while (count($path) != 0) {
			$next = array_shift($path);

			foreach (glob($next) as $file) {
				// If directory add to path array

				if (is_dir($file)) {
					$path[] = $file . '/*';
				}

				// Add the file to the files to be deleted array
				if (is_file($file)) {
					$files[] = $file;
				}
			}
		}
		sort($files);

		foreach ($files as $file) {
			$controller = substr($file, strlen(DIR_APP . 'Controllers/Admin/'));
			$permission = strtolower(substr($controller, 0, strrpos($controller, '.')));

			if (!in_array($permission, $ignore)) {
				$data_permissions[] = $permission;
			}
		}

		return $data_permissions;
	}
}
?>