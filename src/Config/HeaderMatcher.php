<?php

namespace Trunda\PhpCors\Config;

use Trunda\PhpCors\RequestInterface;

class HeaderMatcher extends AbstractArrayMatcher
{
    /**
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    public function applicable(RequestInterface $request)
    {
        return $request->hasHeader('Access-Control-Request-Headers');
    }

    protected function isMatchAllEnabled()
    {
        return false;
    }

    /**
     *
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    protected function doesMatch(RequestInterface $request)
    {
        $all = array_map('strtolower', $this->all());
        foreach ($this->getRequestedHeaders($request) as $header) {
            if (!in_array(strtolower($header), $all)) {
                return false;
            }
        }

        return true;
    }

    private function getRequestedHeaders(RequestInterface $request)
    {
        $line = $request->getHeader('Access-Control-Request-Headers');
        $headers = explode(',', $line);

        return array_map(
            function ($header) {
                return trim($header);
            },
            $headers
        );
    }
}
