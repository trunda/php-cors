<?php

namespace Trunda\PhpCors\Config;

use Trunda\PhpCors\RequestInterface;

class HostMatcher extends AbstractArrayMatcher
{
    use MatchAgainstItem;

    /**
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    public function applicable(RequestInterface $request)
    {
        return true;
    }

    protected function isMatchAllEnabled()
    {
        return false;
    }

    /**
     * @param $item
     * @param RequestInterface $request
     *
     * @return boolean
     */
    protected function doesItemMatch($item, RequestInterface $request)
    {
        $host = $request->getHost();

        return !!preg_match('{'.$item.'}i', $host);
    }
}
