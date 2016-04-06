<?php

namespace Trunda\PhpCors\Config;

use Trunda\PhpCors\RequestInterface;

interface MatcherInterface
{
    /**
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    public function match(RequestInterface $request);

    /**
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    public function applicable(RequestInterface $request);
}
