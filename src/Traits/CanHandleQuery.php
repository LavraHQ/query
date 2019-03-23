<?php

namespace Lavra\Query\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Lavra\Query\Group;
use Query;

trait CanHandleQuery
{
    private function getQueryModifier($method)
    {
        $methodArr = explode('__', $method);

        if (count($methodArr) !== 2) {
            $methodArr[1] = null;
        }

        return $methodArr;
    }
    
    public function handleQuery($builder, $query, Group $group = null)
    {
        $model = $builder->getModel();

        foreach ($query as $param => $grouped) {
            if (is_array(@$model->getQueryableAttributes())) {
                if (in_array($param, $model->getQueryableAttributes()) && is_string($grouped)) {
                    if (Query::hasQueryMethod('_eq')) {
                        Query::getQueryMethod('_eq')
                            ->handleQuery($builder, null, $param, $grouped, $group);
                    }
                }
            }

            if (Query::hasQueryGroup($param)) {
                Query::getQueryGroup($param)
                    ->handleGroup($builder, $grouped);
            }

            if (! is_array($grouped)) {
                continue;
            }

            foreach ($grouped as $method => $test) {
                if (is_array(@$model->getQueryableAttributes())) {
                    if (! in_array($param, $model->getQueryableAttributes())) {
                        continue;
                    }
                }

                [$modifierMethod, $modifier] = $this->getQueryModifier($method);

                if (Query::hasQueryMethod($modifierMethod)) {
                    Query::getQueryMethod($modifierMethod)
                        ->handleQuery($builder, $modifier, $param, $test, $group);
                }
            }
        }
    }
}
