<?php

use Illuminate\Http\Request as LaravelRequest;
use Trunda\PhpCors\Config\HostMatcher;
use Trunda\PhpCors\Laravel\Request;

class HostMatcherTest extends PHPUnit_Framework_TestCase
{
    public function testItDoesNotMatchOnWildcard()
    {
        $this->assertFalse($this->getMatcher(['\*'])->match($this->createRequest()));
    }

    public function testItMatchesCaseInsensitively()
    {
        $matcher = $this->getMatcher();
        $this->assertTrue($matcher->match($this->createRequest('LOCALHOST')));
        $this->assertTrue($matcher->match($this->createRequest('localhost')));
    }

    protected function createRequest($host = 'localhost')
    {
        $request = LaravelRequest::createFromBase(
            LaravelRequest::create('/', 'GET', [], [], [], ['HTTP_HOST' => $host])
        );

        return new Request($request);
    }

    protected function getMatcher($list = ['^localhost$'])
    {
        return new HostMatcher($list);
    }
}
