<?php

namespace Lavra\Query\Methods;

use App\Support\Query\Query\QueryMethod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Support\Query\Query\QueryGroup;
use Lavra\Query\Method;
use Lavra\Query\Group;

class LessThan extends Method
{
    public function getQueryAccessor()
    {
        return '_lt';
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
        $operator = '<';

        $modifier = strtolower($modifier);

        $operations = [
          null => '',
          'date' => 'Date',
          'month' => 'Month',
          'day' => 'Day',
          'year' => 'Year',
          'time' => 'Time',
          'column' => 'Column',
        ];

        if ($group && $group->getGroupAccessor() === '_or') {
            return $builder->{'orWhere' . $operations[$modifier]}($attribute, $operator, $test);
        }

        return $builder->{'where' . $operations[$modifier]}($attribute, $operator, $test);
    }
}
