<?php

namespace Lavra\Query;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Lavra\Query\Traits\CanHandleQuery;

abstract class Group
{
    use CanHandleQuery;

    public function __construct()
    {
    }

    public function getGroupAccessor()
    {
        throw new \Exception('QueryGroup does not implement the getGroupAccessor method.');
    }

    abstract public function handleGroup(Builder &$builder, $grouped) : Builder;
}
