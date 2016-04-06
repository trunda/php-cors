<?php
use Illuminate\Http\Request as LaravelRequest;
use Trunda\PhpCors\Config\HeaderMatcher;
use Trunda\PhpCors\Laravel\Request;

class HeaderMatcherTest extends PHPUnit_Framework_TestCase
{
    public function testItNotAllowsWildcard()
    {
        $this->assertFalse($this->getMatcher(['*'])->match($this->createRequest()));
    }

    public function testItIsApplicapleOnlyWhenHeaderIsSet()
    {
        $this->assertFalse($this->getMatcher()->applicable($this->createRequest(null)));
    }

    public function testItShouldMatchWhenAllAreInAllowed()
    {
        $request = $this->createRequest(['X-Test', 'X-Test2']);
        $matcher = $this->getMatcher(['A', 'B', 'X-Test', 'X-Test2']);
        $this->assertTrue($matcher->match($request));
    }

    public function testItShouldNotMatchWhenAllAtLeasOnInNotAllowed()
    {
        $request = $this->createRequest(['X-Test', 'X-Test2']);
        $matcher = $this->getMatcher(['A', 'B', 'X-Test']);
        $this->assertFalse($matcher->match($request));
    }

    protected function createRequest($headers = ['X-Test'])
    {
        $request = LaravelRequest::createFromBase(LaravelRequest::create('/', 'GET'));
        if ($headers !== null) {
            $request->headers->set('Access-Control-Request-Headers', implode(', ', $headers));
        }

        return new Request($request);
    }

    protected function getMatcher($list = ['X-Test'])
    {
        return new HeaderMatcher($list);
    }
}
