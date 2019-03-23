<?php

namespace Lavra\Query\Methods;

use App\Support\Query\Query\QueryMethod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Support\Query\Query\QueryGroup;
use Lavra\Query\Method;
use Lavra\Query\Group;

class IsNotNull extends Method
{
    public function getQueryAccessor()
    {
        return '_nnull';
    }

    /**
     * Handles specifying the Builder query for this QueryMethod.
     *
     * @param Builder $builder
     * @param string $attribute
     * @param string $test
     * @return void
     */
    public function handleQuery(Builder &$builder, $modifier, string $attribute, $test, Group $group = null): Builder
    {
        dump($attribute);

        if ($group && $group->getGroupAccessor() === '_or') {
            return $builder->orWhereNotNull($attribute);
        }

        return $builder->whereNotNull($attribute);
    }
}
