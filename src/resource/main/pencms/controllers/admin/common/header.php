<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\Common;

class HeaderController extends \AdminController {
	public $styles_arr = array(
		'plugins/morris/morris.css',
		'plugins/jvectormap/jquery-jvectormap-1.2.2.css',
		'plugins/datepicker/datepicker3.css',
		'plugins/daterangepicker/daterangepicker.css',
		'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'
	);

  public function index() {
  	$data['heading_title'] = $this->helper->getTitle() . ' - ' .$this->config->get('config_meta_title');

  	$languages = $this->language->load('common/header');
  	foreach($languages as $key => $value){
  		$data[$key] = $value;
  	}

  	$this->helper->addStyle($this->styles_arr);

  	$data['styles'] = $this->helper->getStyles();
  	$data['body_class'] = $this->helper->getBodyClass();

  	$data['template'] = $this->config->get('config_admin_template');

  	$data['logout'] = $this->url->link('logout');

  	if($this->user){
  		$data['fullname'] = $this->user->fullname;
  	}

  	$data['site_url'] = $this->url->link('common/dashboard');
  	$data['title'] = $this->config->get('config_meta_title');

  	$data['menu'] = $this->load->controller('common/menu');

    return $this->load->view('common/header', $data);
  }
}
