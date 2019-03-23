<?php

namespace Lavra\Query;

use Illuminate\Support\ServiceProvider;
use Query;
use Lavra\Query\Methods\EqualTo;
use Lavra\Query\Methods\NotEqualTo;
use Lavra\Query\Methods\LessThan;
use Lavra\Query\Methods\LessThanOrEqual;
use Lavra\Query\Methods\GreaterThan;
use Lavra\Query\Methods\GreaterThanOrEqual;
use Lavra\Query\Methods\InArray;
use Lavra\Query\Methods\NotInArray;
use Lavra\Query\Methods\IsNotNull;
use Lavra\Query\Methods\IsBetween;
use Lavra\Query\Methods\IsNotBetween;
use Lavra\Query\Groups\OrQueryGroup;
use Lavra\Query\Groups\AndQueryGroup;
use Lavra\Query\Methods\IsNull;

class QueryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerQuery();
        $this->registerMethods();
        $this->registerGroups();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register Query as a singleton.
     *
     * @return void
     */
    protected function registerQuery()
    {
        $this->app->singleton(Query::class, function () {
            return new Query();
        });
    }

    /**
     * Register the provided Methods.
     *
     * @return void
     */
    protected function registerMethods()
    {
        Query::addQueryMethod(EqualTo::class);
        Query::addQueryMethod(NotEqualTo::class);
        Query::addQueryMethod(LessThan::class);
        Query::addQueryMethod(LessThanOrEqual::class);
        Query::addQueryMethod(GreaterThan::class);
        Query::addQueryMethod(GreaterThanOrEqual::class);
        Query::addQueryMethod(InArray::class);
        Query::addQueryMethod(NotInArray::class);
        Query::addQueryMethod(IsNull::class);
        Query::addQueryMethod(IsNotNull::class);
        Query::addQueryMethod(IsBetween::class);
        Query::addQueryMethod(IsNotBetween::class);
    }

    /**
      * Register the provided Groups.
      *
      * @return void
      */
    protected function registerGroups()
    {
        Query::addQueryGroup(OrQueryGroup::class);
        Query::addQueryGroup(AndQueryGroup::class);
    }
}
