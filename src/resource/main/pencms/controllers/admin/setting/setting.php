<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\Setting;
use AdminController;

class SettingController extends AdminController {
  public function index() {
  	/* Languages */
  	$data = $this->language->load('setting/setting');

  	$this->helper->setTitle($this->language->get('heading_title'));

  	$_model = $this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$_model->editSetting('config', $this->request->post);

			$data['success'] = $this->session->get('text_success');

			return redirect($this->url->link('setting/setting'));
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/setting')
		);

		$data['action'] = $this->url->link('setting/setting');

		foreach($_model->default_data as $key => $value){
			if (isset($this->request->post[$key])) {
				$data[$key] = $this->request->post[$key];
			} elseif($this->config->get($key)) {
				$data[$key] = $this->config->get($key);
			} else {
				$data[$key] = $value;
			}
		}

		$data['admin_templates'] = array();

    $list_admin_templates = array_map('basename', \File::directories(DIR_TEMPLATE.'Admin'));
    foreach ($list_admin_templates as $template) {
      $data['admin_templates'][] = array(
      	'name' => $template
      );
    }

  	$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

    return $this->load->view('setting/setting', $data);
  }

  public function validate(){
  	return true;
  }
}
