<?php

namespace Trunda\PhpCors\Laravel;

use Illuminate\Http\Request as LaravelRequest;
use Trunda\PhpCors\RequestInterface;

class Request implements RequestInterface
{

    /** @var  LaravelRequest */
    protected $request;

    /**
     * Request constructor.
     *
     * @param LaravelRequest $request
     */
    public function __construct(LaravelRequest $request)
    {
        $this->request = $request;
    }

    public function getHeader($name)
    {
        return $this->request->headers->get($name);
    }

    public function getHost()
    {
        return $this->request->getHost();
    }

    public function getSchemeAndHttpHost()
    {
        return $this->request->getSchemeAndHttpHost();
    }

    public function hasHeader($name)
    {
        return $this->request->headers->has($name);
    }
}
