<?php

namespace Trunda\PhpCors\Config;

trait ByRegexp
{
    /** @var  boolean */
    private $byRegexp;

    /**
     * @return boolean
     */
    public function isByRegexp()
    {
        return $this->byRegexp;
    }

    /**
     * @param boolean $byRegexp
     *
     * @return self
     */
    public function byRegexp($byRegexp)
    {
        $this->byRegexp = $byRegexp;

        return $this;
    }
}
