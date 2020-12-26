<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class RepoSearchTest extends TestCase
{
    public function testGet()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
