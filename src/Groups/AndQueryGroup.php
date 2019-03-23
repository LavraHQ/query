<?php

namespace Lavra\Query\Groups;

use \Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Lavra\Query\Group;

class AndQueryGroup extends Group
{
    public function getGroupAccessor()
    {
        return '_and';
    }

    public function handleGroup(Builder &$builder, $grouped): Builder
    {
        $group = $this;

        $builder->where(function ($query) use ($grouped, $group) {
            foreach ($grouped as $within) {
                $this->handleQuery($query, $within, $group);
                dump($query);
            }
        });

        return $builder;
    }
}
