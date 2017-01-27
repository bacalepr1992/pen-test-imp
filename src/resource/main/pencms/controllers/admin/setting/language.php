<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\Setting;
use AdminController;

class LanguageController extends AdminController {
	private $error;

  public function index() {
  	/* Languages */
  	$data = $this->language->load('setting/language');

  	$data['success'] = $this->session->get('success');

  	return $this->renderList($data);
  }

  public function edit(){
  	if (!$this->permission->hasPermission('edit', 'setting/language')) {
			$this->error['warning'] = $this->language->get('text_error_permission_edit');
		} else {
	  	$this->language->load('setting/language');

	  	$_model = $this->load->model('setting/language');

	    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
	    	$_model->editLanguage($this->request->get['language_id'], $this->request->post);

	    	$this->session->flash('success', $this->language->get('edit_success'));

	    	return redirect($this->url->link('setting/language'));
	    }
	  }

    return $this->renderForm();
  }

  public function renderList($data = array()){
  	$this->helper->setTitle($this->language->get('heading_title'));

  	if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'code';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

  	if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		/* Breadcrumbs */
  	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/language', $url)
		);

		/* Button */
		$data['add'] = $this->url->link('setting/language/add');
		$data['delete'] = $this->url->link('setting/language/delete');

		/* Data */
  	$_model = $this->load->model('setting/language');

  	$languages = $_model->getLanguages();

  	foreach($languages as $language){
  		$data['languages'][] = array(
  			'code' => $language['code'],
  			'name' => $language['name'],
  			'href' => $this->url->link('setting/language/edit', 'language_id=' . $language['language_id'])
  		);
  	}

  	$url = '';

  	if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

  	$data['sort_name'] = $this->url->link('setting/language','sort=name' . $url);
		$data['sort_code'] = $this->url->link('setting/language', 'sort=code' . $url);

		$data['sort'] = $sort;
		$data['order'] = $order;

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

  	$total_language = $_model->getTotalLanguages();

  	/* Pagination */
		$this->pagination->total = $total_language;
		$this->pagination->page = $page;
		$this->pagination->limit = $this->config->get('config_limit_admin');
		$this->pagination->url = $this->url->link('setting/language','page={page}' . $url);

		$data['pagination'] = $this->pagination->render();

  	$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

    return $this->load->view('setting/language_list', $data);
  }

  public function renderForm(){
  	$data = $this->language->load('setting/language');

  	$this->helper->setTitle($this->language->get('heading_title'));

  	$data['text_form'] = !isset($this->request->get['language_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

  	/* Breadcrumbs */
  	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('setting/language')
		);

		if (!isset($this->request->get['language_id'])) {
			$data['action'] = $this->url->link('setting/language/add');
		} else {
			$data['action'] = $this->url->link('setting/language/edit', 'language_id=' . $this->request->get['language_id']);
		}

		$data['cancel'] = $this->url->link('setting/language');

  	$_model = $this->load->model('setting/language');

  	$data['language'] = $_model->getLanguage($this->request->get['language_id']);

  	$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

  	return $this->load->view('setting/language_form', $data);
  }

  public function validateForm() {
		if (!$this->permission->hasPermission('edit', 'setting/language')) {
			$this->error['warning'] = 'NO NO NO';
		}

		return !$this->error;
	}
}
?>