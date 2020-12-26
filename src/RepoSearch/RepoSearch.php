<?php

namespace reposearch\RepoSearch;

use reposearch\RepoSearch\Repositories\AbstractRepository;

class Search
{
    protected array $repositories = [];

    public function addRepository(AbstractRepository $repository)
    {
        $this->repositories[] = $repository;
    }

    public function search(string $query): array
    {
        $result = [];

        foreach ($this->repositories as $repo) {
            $result = array_merge($result, $repo->search($query));
        }

        return $result;
    }
}
