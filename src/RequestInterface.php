<?php

namespace Trunda\PhpCors;

interface RequestInterface
{
    public function hasHeader($name);

    public function getHeader($name);

    public function getSchemeAndHttpHost();

    public function getHost();
}
