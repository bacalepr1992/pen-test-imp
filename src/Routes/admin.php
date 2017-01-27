<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/
Route::group(['prefix' => PenLocalisation::setLocale(), 'middleware' => ['PenFramework\Middleware\Localisation']], function() {
		/* Admin */
		Route::group(['prefix' => 'admin'], function(){
			/* Login */
			Route::get('/access_denied', [
				'as' => 'admin.access_denied',
				'uses' => '\PenFramework\Controller\ErrorController@access_denied'
			]);
			Route::get('/', function () {
			    return redirect()->route('admin.login');
			});
			Route::get('/login', [
				'as' => 'admin.login',
				'uses' => '\PenFramework\Controller\LoginController@showLoginForm'
			]);
			Route::post('/login', [
				'as' => 'admin.login',
				'uses' => '\PenFramework\Controller\LoginController@login'
			]);
			/* Logout */
			Route::get('/logout', [
				'as' => 'admin.logout',
				'uses' => '\PenFramework\Controller\LoginController@logout'
			]);
			Route::any('module/{module}', '\PenFramework\Controller\ModuleManager@runModule')->where('module', '^(?!elfinder)(?!_debugbar)([A-z\d-\/_.]+)?');
			Route::any('module/{module}/{route}', '\PenModule@runModule')->where('module', '^(?!elfinder)(?!_debugbar)([A-z\d-\/_.]+)?')->where('route', '^(?!elfinder)(?!_debugbar)([A-z\d-\/_.]+)?');

			/* Orther Controller */
			Route::group(['middleware' => ['auth', '\PenFramework\Middleware\Access']], function(){
				/* Module */
				Route::any('/{route}', '\PenFramework\Controller\AdminController@run')->where('route', '^(?!elfinder)(?!_debugbar)([A-z\d-\/_.]+)?');
			});

		});
});