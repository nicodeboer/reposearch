<?php

namespace reposearch\RepoSearch;

use reposearch\RepoSearch\Repositories\AbstractRepository;

/**
 * Repository search class
 *
 * Class RepoSearch
 * @package reposearch\RepoSearch
 */
class RepoSearch
{
    protected array $repositories = [];

    public function addRepository(AbstractRepository $repository)
    {
        $this->repositories[] = $repository;
    }

    /**
     * Actual search in the configured repositories.
     * @todo:
     *
     * @param string $query
     * @return array
     */
    public function search(string $query): array
    {
        $result = [];

        foreach ($this->repositories as $repo) {
            $result = array_merge($result, $repo->search($query));
        }

        return $result;
    }
}
