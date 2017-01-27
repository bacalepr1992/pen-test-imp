<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/
namespace PenFramework\Providers;

use Illuminate\Support\ServiceProvider;
use PenFramework\Library\Localisation as PenLocalisation;

class PenLocalisationServiceProvider extends ServiceProvider {

    protected $defer = false;

    public function boot() {}

    public function provides(){}

    public function register() {
      $this->app[ PenLocalisation::class ] = $this->app->share(function () {
        return new PenLocalisation();
      });

      $this->app->alias(PenLocalisation::class, 'penlocalisation');
    }
}
