<?php

namespace Trunda\PhpCors\Config;

use Trunda\PhpCors\RequestInterface;

abstract class AbstractArrayMatcher implements MatcherInterface
{
    const WILDCARD = '*';
    /** @var  array */
    protected $list;

    /**
     * AbstractArrayMatcher constructor.
     *
     * @param array $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->list;
    }

    /**
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    public function match(RequestInterface $request)
    {
        if ($this->applicable($request)) {
            if ($this->isMatchAllEnabled() || $this->doesMatch($request)) {
                return true;
            }
        }

        return false;
    }

    /**
     *
     * @param \Trunda\PhpCors\RequestInterface $request
     *
     * @return bool
     */
    abstract protected function doesMatch(RequestInterface $request);


    /**
     * @return boolean
     */
    protected function isMatchAllEnabled()
    {
        return in_array(self::WILDCARD, $this->list);
    }
}
