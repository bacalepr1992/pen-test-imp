<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\User;
use AdminController;

class UserController extends AdminController {
	private $error;

	/* Validate Rules */
	private $rules = [
		'fullname' => 'required|min:3|max:64',
		'email'    => 'required|email|unique:user|min:3|max:64',
		'password' => 'required|confirmed'
	];

  public function index() {
  	$data = $this->language->load('user/user');

  	$data['success'] = $this->session->get('success');

  	return $this->renderList($data);
  }

  public function add(){
  	$this->language->load('user/user');

    $this->helper->setTitle($this->language->get('heading_title'));

    $_model = $this->load->model('user/user');

  	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$_model->addUser($this->request->post);

			$this->session->flash('success', $this->language->get('add_success'));

			return redirect($this->url->link('user/user'));
	  }
	  return $this->renderForm();
	}

  public function edit(){
  	if (!$this->permission->hasPermission('edit', 'user/user')) {
			$this->error['warning'] = $this->language->get('text_error_permission_edit');
		} else {
	  	$this->language->load('user/user');

	  	$_model = $this->load->model('user/user');

	    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
	    	$_model->editUser($this->request->get['user_id'], $this->request->post);

	    	$this->session->flash('success', $this->language->get('edit_success'));

	    	return redirect($this->url->link('user/user'));
	    }
	  }

    return $this->renderForm();
  }

  public function delete(){}

  public function renderList($data = array()){
  	$this->helper->setTitle($this->language->get('heading_title'));

  	if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'fullname';
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

  	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/user', $url)
		);

  	$data['add'] = $this->url->link('user/user/add');
		$data['delete'] = $this->url->link('user/user/delete');

  	$_model = $this->load->model('user/user');

  	$data['users'] = array();

  	$filter_data = array(
			'sort'  => $sort,
			'order' => $order,
			'start' => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit' => $this->config->get('config_limit_admin')
		);

  	$users = $_model->getUsers($filter_data);

  	foreach($users as $user){
  		$data['users'][] = array(
  			'user_id' => $user->user_id,
  			'fullname' => $user->fullname,
  			'email' => $user->email,
  			'created_at' => $user->created_at,
  			'edit' => $this->url->link('user/user/edit', 'user_id=' . $user->user_id . $url)
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

  	$data['sort_fullname'] = $this->url->link('user/user','sort=fullname' . $url);
		$data['sort_email'] = $this->url->link('user/user', 'sort=email' . $url);

		$data['sort'] = $sort;
		$data['order'] = $order;

		$url = '';

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

  	$total_user = $_model->getTotalUsers();

		$this->pagination->total = $total_user;
		$this->pagination->page = $page;
		$this->pagination->limit = $this->config->get('config_limit_admin');
		$this->pagination->url = $this->url->link('user/user','page={page}' . $url);

		$data['pagination'] = $this->pagination->render();

		/* Required */
  	$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

    return $this->load->view('user/user_list', $data);
  }

  public function renderForm(){
  	$data = $this->language->load('user/user');

  	$_model = $this->load->model('user/user');

  	$this->helper->setTitle($this->language->get('heading_title'));

  	$data['text_form'] = !isset($this->request->get['user_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');

  	/* Breadcrumbs */
  	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/user')
		);

		/* Button */
		if (!isset($this->request->get['user_id'])) {
			$data['action'] = $this->url->link('user/user/add');
		} else {
			$data['action'] = $this->url->link('user/user/edit', 'user_id=' . $this->request->get['user_id']);
		}

		$data['cancel'] = $this->url->link('user/user');

		/* Data */
		if (isset($this->request->get['user_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$user_info = $_model->getUser($this->request->get['user_id']);
		}

		foreach($_model->default_data as $key => $value){
			if (isset($this->request->post[$key])) {
				$data[$key] = $this->request->post[$key];
			} elseif (!empty($user_info)) {
				$data[$key] = $user_info[$key];
			} else {
				$data[$key] = $value;
			}
		}

		$_model_user_group = $this->load->model('user/user_group');

		$data['user_groups'] = $_model_user_group->getUserGroups();

		/* Errors */
		$errors = ['warning', 'fullname', 'email', 'password', 'password_confirmation'];
		foreach($errors as $error){
			if (isset($this->error[$error])) {
				$data['error_'.$error] = $this->error[$error];
			} else {
				$data['error_'.$error] = '';
			}
		}

		/* Required */
		$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

    return $this->load->view('user/user_form', $data);
  }

  /*
	* Validate Form
	* @messages: Translate error
  */

  public function validateForm() {
  	$messages = array(
			'fullname.required'         => $this->language->get('text_error_fullname_required'),
			'fullname.min'              => $this->language->get('text_error_fullname_min_max'),
			'fullname.max'              => $this->language->get('text_error_fullname_min_max'),
			'email.required'            => $this->language->get('text_error_email_required'),
			'email.unique'              => $this->language->get('text_error_email_unique'),
			'email.min'                 => $this->language->get('text_error_email_min_max'),
			'email.max'                 => $this->language->get('text_error_email_min_max'),
			'password.required'         => $this->language->get('text_error_password_required'),
			'password.confirmed'         => $this->language->get('text_error_password_confirmed'),
			'password_confirmation.required' => $this->language->get('text_error_password_confirm_required'),
		);

  	$this->error = $this->validate->make($this->request->post, $this->rules, $messages);

		return !$this->error;
	}

	public function validateDelete() {
		if (!$this->permission->hasPermission('delete', 'user/user_group')) {
			$this->error['warning'] = $this->language->get('text_error_permission_delete');
		}

		return !$this->error;
	}
}
