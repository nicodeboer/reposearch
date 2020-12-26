<?php

namespace reposearch\RepoSearch\Repositories;

/**
 * Interface RepositoryInterface
 *
 * All repository handlers must implement this for querying.
 *
 * @package reposearch\RepoSearch\Repositories
 */
interface RepositoryInterface
{
    function search($query);
}
