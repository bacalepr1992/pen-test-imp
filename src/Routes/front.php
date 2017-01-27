<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/
Route::group(['middleware' => ['PenFramework\Middleware\Localisation']], function() {
	/*Route::get('/', function () {
	    return redirect('front');
	});*/
	/* Front */
	Route::group(['prefix' => 'front'], function () {
		Route::get('/', function(){
			return "<h1>Front page here</h1>";
		});

	    //Route::any('/{route}', '\PenFramework\Controller\PenController@run')->where('route', '^(?!elfinder)(?!_debugbar)([A-z\d-\/_.]+)?');
	});
});