<?php

namespace Lavra\Query\Methods;

use Illuminate\Database\Eloquent\Builder;
use Lavra\Query\Group;
use Lavra\Query\Method;

class NotEqualTo extends Method
{
    public function getQueryAccessor()
    {
        return '_ne';
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
            return $builder->{'orWhere' . $operations[$modifier]}($attribute, '!=', $test);
        }

        return $builder->{'where' . $operations[$modifier]}($attribute, '!=', $test);
    }
}
