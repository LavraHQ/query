<?php

namespace Lavra\Query;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Query
{

    /**
     * Array of QueryMethod classes.
     *
     * @var array
     */
    private $queryMethods = [];

    /**
     * Array of QueryGroup classes.
     *
     * @var array
     */
    private $queryGroups = [];

    /**
     * Array of QueryManipulator classes.
     *
     * @var array
     */
    private $queryManipulators = [];

    public function __construct()
    {
    }

    public function getQueryMethod($queryAccessor)
    {
        foreach ($this->queryMethods as $method) {
            if ($method->getQueryAccessor() === $queryAccessor) {
                return $method;
            }
        }

        return null;
    }

    public function hasQueryMethod($queryAccessor) : bool
    {
        if ($this->getQueryMethod($queryAccessor) === null) {
            return false;
        }

        return true;
    }

    public function getQueryGroup($queryAccessor)
    {
        foreach ($this->queryGroups as $method) {
            if ($method->getGroupAccessor() === $queryAccessor) {
                return $method;
            }
        }

        return null;
    }

    public function hasQueryGroup($queryAccessor) : bool
    {
        if ($this->getQueryGroup($queryAccessor) === null) {
            return false;
        }

        return true;
    }

    public function getQueryManipulator($queryAccessor)
    {
        foreach ($this->queryManipulators as $method) {
            if ($method->getManipulatorAccessor() === $queryAccessor) {
                return $method;
            }
        }

        return null;
    }

    public function hasQueryManipulator($queryAccessor) : bool
    {
        if ($this->getQueryManipulator($queryAccessor) === null) {
            return false;
        }

        return true;
    }

    public function addQueryMethod($method)
    {
        $class = new $method;

        if ($this->getQueryMethod($class->getQueryAccessor()) === null) {
            return array_push($this->queryMethods, $class);
        }

        throw new \Exception('addQueryMethod: Trying to add duplicate getQueryAccessor [' . $class->getQueryAccessor() . '].');
    }

    public function addQueryGroup($group)
    {
        $class = new $group;

        if ($this->getQueryGroup($class->getGroupAccessor()) === null) {
            return array_push($this->queryGroups, $class);
        }

        throw new \Exception('addQueryGroup: Trying to add duplicate getGroupAccessor [' . $class->getGroupAccessor() . '].');
    }

    public function addQueryManipulator($manipulator)
    {
        $class = new $manipulator;

        if ($this->getQueryManipulator($class->getManipulatorAccessor()) === null) {
            return array_push($this->queryManipulators, $class);
        }

        throw new \Exception('addQueryManipulator: Trying to add duplicate getManipulatorAccessor [' . $class->getManipulatorAccessor() . '].');
    }
}
