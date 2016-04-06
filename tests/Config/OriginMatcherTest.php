<?php

use Illuminate\Http\Request as LaravelRequest;
use Trunda\PhpCors\Config\OriginMatcher;
use Trunda\PhpCors\Laravel\Request;

class OriginMatcherTest extends PHPUnit_Framework_TestCase
{
    public function testItShouldNotBeApplicableWithoutOriginHeader()
    {
        $this->assertFalse($this->getMatcher()->applicable($this->createRequest()));
    }

    public function testItShouldNotBeApplicableWhenTheOriginIsSameAsHost()
    {
        $request = $this->createRequest('http://localhost');
        $this->assertFalse($this->getMatcher()->applicable($request));
    }

    public function testItShouldBeApplicableWhenOriginHeaderIsSet()
    {
        $request = $this->createRequest('http://example.com');
        $this->assertTrue($this->getMatcher()->applicable($request));
    }

    public function testItShouldMatchOnWildcard()
    {
        $request = $this->createRequest('http://example.com');
        $this->assertTrue($this->getMatcher(['*'])->match($request));
    }

    public function testItShouldNotMatchOnInvalidOrigin()
    {
        $request = $this->createRequest('http://example.com');
        $this->assertFalse($this->getMatcher(['http://foobar.com'])->match($request));
    }

    public function testItShouldMatchOnValidRegexp()
    {
        $matcher = $this->getMatcher(['^http(s)?://example\.(com|net)$'])
            ->byRegexp(true);
        $this->assertTrue($matcher->match($this->createRequest('http://example.com')));
        $this->assertTrue($matcher->match($this->createRequest('https://example.net')));
    }

    public function testItShouldNotMatchOnCaseMismatch()
    {
        $request = $this->createRequest('http://example.com');
        $this->assertFalse($this->getMatcher(['http://exAmple.com'])->match($request));
    }

    protected function createRequest($origin = null)
    {
        $request = LaravelRequest::createFromBase(LaravelRequest::create('/', 'GET'));
        if ($origin !== null) {
            $request->headers->set('Origin', $origin);
        }

        return new Request($request);
    }

    protected function getMatcher($list = ['http://example.com'])
    {
        return new OriginMatcher($list);
    }
}
