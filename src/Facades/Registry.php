<?php

namespace Linuxstreet\Registry\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Registry
 *
 * @package Linuxstreet\Registry\Facades
 */
class Registry extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'registry';
    }
}
