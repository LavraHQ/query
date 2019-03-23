<?php

namespace Lavra\Query\Interfaces;

interface Operator
{

  /**
     * Returns the accessor used to specify that this operator
     * is being called.
     *
     * @return String
     */
    public function getAccessor(): String;

    /**
     * Returns the operator
     *
     * @return String
     */
    public function isAccessedBy(String $accessor): String;
}
