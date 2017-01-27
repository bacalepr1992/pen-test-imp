<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\Common;
use Illuminate\Http\Request;
use AdminController;

class MenuController extends AdminController {
  public function index() {
  	$data = $this->language->load('common/menu');

  	$data['fullname'] = '';

  	if($this->user){
  		$data['fullname'] = $this->user->fullname;
  	}

    return $this->load->view('common/menu', $data);
  }
}
