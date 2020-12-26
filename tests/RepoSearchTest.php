<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use reposearch\RepoSearch\RepoSearch;

class RepoSearchTest extends TestCase
{
    public function testSearch()
    {
        $search = new RepoSearch();
        $this->assertEquals([], $search->search('foobar'));
    }
}
