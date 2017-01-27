<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\Setting;
use AdminController, File;

class LogController extends AdminController {
	public function index() {
		$data = $this->language->load('setting/log');

  	$this->helper->setTitle($this->language->get('heading_title'));

  	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/log')
		);

		if(isset($this->request->get['download']) && !empty($this->request->get['download'])){
	  	$path = $this->log->pathToLogFile($this->request->get['download']);
	  	return response()->download($path);
		}

		if(isset($this->request->get['delete']) && !empty($this->request->get['delete'])){
	  	File::delete($this->log->pathToLogFile($this->request->get['delete']));
	  	return redirect($this->url->link('setting/log'));
		}

  	$data['logs'] = $this->log->getLogs();
  	$data['download'] = !empty($this->log->getFileName()) ? $this->url->link('setting/log', 'download=' . $this->log->getFileName()) : '';
  	$data['delete'] = !empty($this->log->getFileName()) ? $this->url->link('setting/log', 'delete=' . $this->log->getFileName()) : '';

  	/* Required */
  	$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

  	return $this->load->view('setting/log', $data);
	}

}
?>