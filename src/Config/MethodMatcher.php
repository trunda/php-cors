<?php

namespace Trunda\PhpCors\Config;

use Trunda\PhpCors\RequestInterface;

class MethodMatcher extends AbstractArrayMatcher
{
    use MatchAgainstItem;

    /**
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    public function applicable(RequestInterface $request)
    {
        return $request->hasHeader('Access-Control-Request-Method');
    }

    /**
     * @return bool
     */
    protected function isMatchAllEnabled()
    {
        return false;
    }

    /**
     * @param $item
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    protected function doesItemMatch($item, RequestInterface $request)
    {
        return $item === $request->getHeader('Access-Control-Request-Method');
    }
}
