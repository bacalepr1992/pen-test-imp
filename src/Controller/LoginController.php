<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App, Validator, Redirect, Auth, Session;
use \PenFramework\Controller\AdminController;

class LoginController extends AdminController {
	use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/common/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::middleware('guest', ['except' => ['logout', 'getLogout']]);
        parent::__construct();
    }

    public function showLoginForm() {
    	/* Languages */
    	$data = $this->language->load('common/login');

    	$this->helper->setTitle($this->language->get('heading_title'));

    	$data['action'] = $this->url->setUrl($this->url->getLocale() .'/admin/login');

    	$data['code'] = 'en';

    	$data['languages'] = array();

    	$_model = $this->load->model('setting/language');

    	$languages = $_model->getLanguages();

    	foreach($languages as $language){
    		$data['languages'][] = array(
    			'code' => $language['code'],
    			'name' => $language['name'],
    			'href' => $this->url->setUrl($language['code'] . '/admin/login')
    		);
    	}

    	$data['header'] = $this->load->controller('common/header');
    	$data['footer'] = $this->load->controller('common/footer');

    	return $this->load->view('common/login', $data);
    }

    public function login() {
    	$remember = isset($this->request->post['remember']) ? true : false;
      	$validation = $this->validator($this->request->post);

      	if($validation->passes()){
	        $user = Auth::attempt(array(
	                'email' => $this->request->post['email'],
	                'password' => $this->request->post['password']
	              ), $remember);
	        if ($user) {
	        	return redirect($this->url->getLocale().$this->redirectTo);
	        } else {
	            Session::flash('message', 'Đăng nhập không thành công. Vui lòng thử lại!');
	            return redirect()->back();
	        }
      	} else {
          	return redirect()->back()
	          	->withInput()
	          	->withErrors($validation);
      	}
    }

    public function validator(array $data) {
    	$this->language->load('common/login');
        $rules = [
            'email' => 'required',
            'password' => 'required'
        ];
        $messages = array(
        	'password.min' => $this->language->get('text_password_min')
        );
        return Validator::make($data, $rules, $messages);
    }

    public function logout(){
    	Auth::logout();
      Session::flush();

    	return redirect($this->url->locale . '/admin');
    }
}
