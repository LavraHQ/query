<?php

namespace Lavra\Query\Groups;

use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Lavra\Query\Group;

class OrQueryGroup extends Group
{
    public function getGroupAccessor()
    {
        return '_or';
    }

    public function handleGroup(Builder &$builder, $grouped): Builder
    {
        $group = $this;

        $builder->orWhere(function ($query) use ($grouped, $group) {
            foreach ($grouped as $within) {
                $this->handleQuery($query, $within, $group);
            }
        });

        return $builder;
    }
}
