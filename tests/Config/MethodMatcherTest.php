<?php

use Illuminate\Http\Request as LaravelRequest;
use Trunda\PhpCors\Config\MethodMatcher;
use Trunda\PhpCors\Laravel\Request;

class MethodMatcherTest extends PHPUnit_Framework_TestCase
{
    public function testItIsNotApplicableWhenNoHeaderIsSet()
    {
        $this->assertFalse($this->getMatcher()->applicable($this->createRequest(null)));
    }

    public function testItShoubleBeApplicableWhenHeaderIsSet()
    {
        $this->assertTrue($this->getMatcher()->applicable($this->createRequest()));
    }

    public function testItDoesNotMatchOnWildcard()
    {
        $this->assertFalse($this->getMatcher(['*'])->match($this->createRequest()));
    }

    public function testItMatchesCaseSensitively()
    {
        $matcher = $this->getMatcher();
        $this->assertFalse($matcher->match($this->createRequest('get')));
        $this->assertTrue($matcher->match($this->createRequest('GET')));
    }

    protected function createRequest($method = 'GET')
    {
        $request = LaravelRequest::createFromBase(LaravelRequest::create('/', 'GET'));
        if ($method !== null) {
            $request->headers->set('Access-Control-Request-Method', $method);
        }

        return new Request($request);
    }

    protected function getMatcher($list = ['GET'])
    {
        return new MethodMatcher($list);
    }
}
