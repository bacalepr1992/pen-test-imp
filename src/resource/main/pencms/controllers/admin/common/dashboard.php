<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\Common;

class DashboardController extends \AdminController {
  public function index() {
  	/* Languages */
  	$data = $this->language->load('common/dashboard');

  	$this->helper->setTitle($this->language->get('heading_title'));

  	$data['menu'] = $this->load->controller('common/menu');
  	$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

    return $this->load->view('common/dashboard', $data);
  }
}
