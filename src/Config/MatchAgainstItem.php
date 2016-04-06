<?php
namespace Trunda\PhpCors\Config;

use Trunda\PhpCors\RequestInterface;

trait MatchAgainstItem
{
    abstract protected function doesItemMatch($item, RequestInterface $request);

    protected function doesMatch(RequestInterface $request)
    {
        foreach ($this->all() as $item) {
            if ($this->doesItemMatch($item, $request)) {
                return true;
            }
        }

        return false;
    }
}
