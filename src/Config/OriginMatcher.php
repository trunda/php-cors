<?php

namespace Trunda\PhpCors\Config;

use Trunda\PhpCors\RequestInterface;

class OriginMatcher extends AbstractArrayMatcher
{
    use ByRegexp;
    use MatchAgainstItem;

    /**
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    public function applicable(RequestInterface $request)
    {
        return (
            $request->hasHeader('Origin') &&
            $request->getHeader('Origin') !== $request->getSchemeAndHttpHost()
        );
    }

    /**
     * @param $item
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    protected function doesItemMatch($item, RequestInterface $request)
    {
        $origin = $request->getHeader('Origin');

        return (
            $origin === $request ||
            ($this->isByRegexp() && preg_match('{'.$item.'}', $origin))
        );
    }
}
