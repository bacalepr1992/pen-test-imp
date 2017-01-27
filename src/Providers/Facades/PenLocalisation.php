<?php
/******************************************************
 * @package: Pen Framework
 * @author: pencms team
 * @copyright: Copyright (C) 2016 www.pencms.com. All rights reserved.
 * @license: MIT
*******************************************************/

namespace PenFramework\Providers\Facades;

use Illuminate\Support\Facades\Facade;

class PenLocalisation extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'penlocalisation';
    }
}
