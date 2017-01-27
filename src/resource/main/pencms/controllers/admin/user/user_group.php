<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace App\PenCMS\Controllers\Admin\User;

class UserGroupController extends \AdminController {

  private $error = array();

  private $data_default = array(
  	'name' => '',
  	'description' => ''
  );

  public function index() {
  	$data = $this->language->load('user/user_group');

    $data['success'] = $this->session->get('success');

    return $this->renderList($data);
  }

  public function add(){
  	$this->language->load('user/user_group');

    $this->helper->setTitle($this->language->get('heading_title'));

    $_model = $this->load->model('user/user_group');

  	if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
		$_model->addUserGroup($this->request->post);

		$this->session->flash('success', $this->language->get('add_success'));

		return redirect($this->url->link('user/user_group'));
	}

	return $this->renderForm();
  }

  public function edit()
  {
  	$this->language->load('user/user_group');

  	$_model = $this->load->model('user/user_group');

    if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
    	$_model->editUserGroup($this->request->get['user_group_id'], $this->request->post);

    	$this->session->flash('success', $this->language->get('edit_success'));

    	return redirect($this->url->link('user/user_group'));
    }

    return $this->renderForm();
  }

  public function delete() {
		$this->language->load('user/user_group');

		$_model = $this->load->model('user/user_group');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			$_model->deleteUserGroup($this->request->post['selected']);

			$this->session->flash('success', $this->language->get('delete_success'));

			return redirect($this->url->link('user/user_group'));
		}

		return $this->renderList();
	}

  public function renderList($data = array()){
  	$this->helper->setTitle($this->language->get('heading_title'));

  	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/user_group')
		);

  	$_model = $this->load->model('user/user_group');

  	$user_groups = $_model->getUserGroups();

  	$data['user_groups'] = array();

  	foreach($user_groups as $user_group){
  		$data['user_groups'][] = array(
  			'user_group_id' => $user_group['user_group_id'],
  			'name' => $user_group['name'],
  			'description' => $user_group['description'],
  			'edit' => $this->url->link('user/user_group/edit', 'user_group_id=' . $user_group['user_group_id'])
  		);
  	}

  	$data['add'] = $this->url->link('user/user_group/add');
  	$data['delete'] = $this->url->link('user/user_group/delete');

  	if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

  	$data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

    return $this->load->view('user/user_group_list', $data);
  }

  public function renderForm(){
  	$this->permission->hasPermission('edit', 'user/user_group');
  	$data = $this->language->load('user/user_group');

    $this->helper->setTitle($this->language->get('heading_title'));

  	$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('user/user_group')
		);

		$_model = $this->load->model('user/user_group');

    if (isset($this->request->get['user_group_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$data_info = $_model->getUserGroup($this->request->get['user_group_id']);

    	$permission = $this->permission->getPermission($this->request->get['user_group_id']);
		}

		if(isset($this->request->get['user_group_id'])){
			$data['action'] = $this->url->link('user/user_group/edit', 'user_group_id=' . $this->request->get['user_group_id']);
		} else {
			$data['action'] = $this->url->link('user/user_group/add');
		}

		$data['cancel'] = $this->url->link('user/user_group');

		foreach($this->data_default as $key => $value){
			if (isset($this->request->post[$key])) {
				$data[$key] = $this->request->post[$key];
			} elseif (!empty($data_info)) {
				$data[$key] = $data_info[$key];
			} else {
				$data[$key] = $value;
			}
		}

		$errors = array('warning', 'name', 'description');

		foreach($errors as $error) {
			if(!empty($this->error[$error]))
				$data['error_'.$error] =  $this->error[$error];
		}

		$data['permissions'] = array();

    $results = $this->permission->getAllController();
    foreach($results as $result){
    	$data['permissions'][] = array(
    		'code' => $result,
    		'name' => str_replace('/', ' > ', $result)
    	);
    }

    $data['view'] = isset($permission['view']) ? $permission['view'] : array();
    $data['edit'] = isset($permission['edit']) ? $permission['edit'] : array();
    $data['delete'] = isset($permission['delete']) ? $permission['delete'] : array();

    $data['header'] = $this->load->controller('common/header');
  	$data['footer'] = $this->load->controller('common/footer');

   	return $this->load->view('user/user_group_form', $data);
  }

  public function validateForm() {
		if (!$this->permission->hasPermission('edit', 'user/user_group')) {
			$this->error['warning'] = $this->language->get('text_error_permission_edit');
		}

		if (!$this->request->post['name'] || mb_strlen($this->request->post['name']) < 3 || mb_strlen($this->request->post['name']) > 64) {
			$this->error['name'] = $this->language->get('text_error_name');
		}

		if (!$this->request->post['description'] || mb_strlen($this->request->post['description']) < 3 || mb_strlen($this->request->post['description']) > 64) {
			$this->error['description'] = $this->language->get('text_error_description');
		}

		return !$this->error;
	}

	public function validateDelete() {
		if (!$this->permission->hasPermission('delete', 'user/user_group')) {
			$this->error['warning'] = $this->language->get('text_error_permission_delete');
		}

		return !$this->error;
	}
}
