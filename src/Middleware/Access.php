<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Middleware;

use Closure;
use \Illuminate\Contracts\Auth\Guard;
use \PenFramework\Library\Permission;

class Access {
	protected $auth;
	protected $permission;
	private $obj;

	public function __construct(Guard $auth)
  {
    $this->auth = $auth;
    $this->obj = app('pen_permission');
    $this->permission = $this->obj->getPermission($this->auth->user()->user_group_id);
  }

  public function handle($request, Closure $next)
  {
    if(!$this->obj->check($this->permission['view'], $request->route('route'))) {
    	return redirect()->action('\PenFramework\Controller\ErrorController@access_denied');
    }

    return $next($request);
  }
}
