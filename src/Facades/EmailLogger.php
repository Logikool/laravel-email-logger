<?php

namespace Logikool\LaravelEmailLogger\Facades;

use Illuminate\Support\Facades\Facade;

class EmailLogger extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'email-logger';
    }
}
