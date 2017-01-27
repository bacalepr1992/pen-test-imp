<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Controller;
use \PenFramework\Controller\AdminController;

class ErrorController extends AdminController {
	public function __construct(){
		parent::__construct();
	}

	public function error404(){
		$this->helper->setTitle('Page not found');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		return $this->load->view('error/error404', $data);
	}

	public function access_denied(){
		$this->helper->setTitle('Access Denied');

		$data['header'] = $this->load->controller('common/header');
		$data['footer'] = $this->load->controller('common/footer');

		return $this->load->view('error/access_denied', $data);
	}
}
?>