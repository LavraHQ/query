<?php

namespace Lavra\Query\Interfaces;

use Illuminate\Database\Eloquent\Builder;

interface Method
{

    /**
     * Returns the accessor used to specify that this method
     * should be used to add a query condition.
     *
     * @return String
     */
    public function getAccessor(): String;

    // /**
    //  * Returns the operator instance which is being used.
    //  *
    //  * @return String
    //  */
    // public function getOperator(): Operator;

    // /**
    //  * Returns the Parent instance.
    //  *
    //  * @return Parent
    //  */
    // public function getParent(): Parent;

    /**
     * Returns a Builder instance that includes any additional wheres for
     * the specific $test.
     *
     * @param Builder $builder
     * @param mixed $test
     * @return Builder
     */
    public function getQueriedBuilder(Builder $builder, String $argument, $test): Builder;
}
