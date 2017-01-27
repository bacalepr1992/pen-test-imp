<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Library;
use Validator;

class Validate {

	public function make($request, $rule, $messages = array()){
		$validation = Validator::make($request, $rule, $messages);
		if(!$validation->passes()){
			$errors = $validation->errors()->messages();
			foreach($errors as $key => $mess){
				foreach($mess as $value){
					$error_arr[$key] = $value;
				}
			}
			return $error_arr;
		}
	}
}