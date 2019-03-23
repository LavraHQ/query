<?php

namespace Lavra\Query;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class Method
{

    /**
     * Setup the QueryMethod class.
     *
     * @param QueryGroup $group
     */
    public function __construct()
    {
    }

    /**
     * Returns the accessor used in the Request query parameter.
     *
     * @return string
     */
    public function getQueryAccessor()
    {
        throw new \Exception('QueryMethod does not implement getQueryAccessor method.');
    }

    /**
     * Handles specifying the Builder query for this QueryMethod.
     *
     * @param Builder $builder
     * @param string $attribute
     * @param string $test
     * @return void
     */
    abstract public function handleQuery(Builder &$builder, $modifier, string $attribute, $test, Group $group = null): Builder;
}
