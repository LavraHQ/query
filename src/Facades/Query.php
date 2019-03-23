<?php

namespace Lavra\Query\Facades;

use Illuminate\Support\Facades\Facade;
use Lavra\Query\Query as QuerySingleton;

class Query extends Facade
{
    /**
       * Get the registered name of the component.
       *
       * @return string
       */
    protected static function getFacadeAccessor()
    {
        return QuerySingleton::class;
    }
}
