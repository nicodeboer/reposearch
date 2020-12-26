<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use reposearch\ApiRequest\Request;

class RequestTest extends TestCase
{
    public function testRequest()
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_ENV['GITLAB_API_TOKEN'] = '';
        $r = [
            'path' => ['v1', 'search'],
            'query' => [
                'q' => 'please-dont-find-anything-from-this'
            ]
        ];
        $request = new Request();
        $this->assertIsArray($request->handle($r));
    }
}
