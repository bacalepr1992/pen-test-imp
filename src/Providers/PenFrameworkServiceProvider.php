<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Providers;

use \Illuminate\Support\ServiceProvider;
use \Illuminate\Foundation\AliasLoader;

require __DIR__.'/../define.php';
require __DIR__.'/../helpers.php';

class PenFrameworkServiceProvider extends ServiceProvider {
	protected $defer = false;
	protected $app;

  public function boot(\Illuminate\Routing\Router $router) {
    // $router->pushMiddlewareToGroup('penlocalisation', \PenFramework\Middleware\Localisation::class); // note here

 		// register routeMiddleware
    $this->app['Illuminate\Contracts\Http\Kernel']->pushMiddleware('PenFramework\Middleware\Localisation');

  	$this->publicResource();
  	$this->handleMigrations();
  	$this->registerRouter();
  }

  public function register() {
  	$this->registerObject();
  	$this->registerViewFinder();

    /* Register Alias */
    $alias = AliasLoader::getInstance();
    $alias->alias('AdminController', '\PenFramework\Controller\AdminController');
    $alias->alias('PenLocalisation', '\PenFramework\Providers\Facades\PenLocalisation');

    /* Register Provider */
    $this->app->register('PenFramework\Providers\PenLocalisationServiceProvider');
  }

  private function handleMigrations() {
      $this->publishes([
          __DIR__.'/../migrations/' => database_path('migrations')
      ], 'migrations');
  }

  private function publicResource(){
  	/* Source */
  	 $this->publishes([
        __DIR__.'/../source/main' => app_path()
    ]);
  	/* View */
  	$this->publishes([
        __DIR__.'/../source/template' => public_path()
    ], 'views');
  }

  /*
  * Register route
  */
  private function registerRouter() {
  	\Route::group(['middleware' => ['web']], function() {
	  	if (!$this->app->routesAreCached()) {
	      require __DIR__.'/../Routes/admin.php';
	    }

	    if (!$this->app->routesAreCached()) {
	      require __DIR__.'/../Routes/front.php';
	    }
		});
  }

  /*
	* Change default view path of Laravel
  */
  private function registerViewFinder() {
    $paths = \Config::get('view.paths');
		array_unshift($paths, DIR_TEMPLATE);
		\Config::set('view.paths', $paths);
  }

  /*
  *	Regiter all object in PenCMS
  */
  private function registerObject(){
  	$this->app->singleton(\PenFramework\Exceptions\Handler::class);

  	$this->app->singleton('pen_helper', function(){
  		return new \PenFramework\Library\Helper();
  	});

  	$this->app->singleton('pen_loader', function(){
  		return new \PenFramework\Library\Loader();
  	});

  	$this->app->singleton('pen_url', function(){
  		return new \PenFramework\Library\PenUrl();
  	});

  	$this->app->singleton('pen_request', function(){
  		return new \PenFramework\Library\PenRequest();
  	});

  	$this->app->singleton('pen_permission', function(){
  		return new \PenFramework\Library\Permission();
  	});

  	$this->app->singleton('pen_config', function(){
  		return new \PenFramework\Library\PenConfig();
  	});

  	$this->app->singleton('pen_language', function(){
  		return new \PenFramework\Library\Language();
  	});

  	$this->app->singleton('pen_session', function(){
  		return new \PenFramework\Library\PenSession();
  	});

  	$this->app->singleton('pen_validate', function(){
  		return new \PenFramework\Library\Validate();
  	});
  }
}
