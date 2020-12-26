<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use reposearch\Authorization\Authorization;

class AuthorizationTest extends TestCase
{
    public function testAuthorization()
    {
        $_SERVER['REQUEST_URI'] = 'http://reposearch.test/v1/search?q=shoppie&token=helloworld';
        $_SERVER['REMOTE_ADDR'] = '127.0.0.1';
        $auth = new Authorization();
        self::assertTrue($auth->isAuthorized());
    }
}
