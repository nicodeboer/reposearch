<?php

namespace reposearch\RepoSearch\Repositories;

class Bitbucket extends AbstractRepository
{

    public function __construct(string $token = null)
    {
        $this->endpoint = '';
        parent::__construct($token);
    }

    function search($q)
    {
        // TODO: Implement search() method.
    }

}
