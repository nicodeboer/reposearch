<?php

namespace reposearch\ApiRequest;

use reposearch\RepoSearch\RepoSearch;
use reposearch\RepoSearch\Repositories\Github;
use reposearch\RepoSearch\Repositories\Gitlab;

class Request
{
    //@todo: Make more dynamic
    private $versions = ['v1'];

    /**
     * Handle API request.
     * @todo: implement some kind of version handling
     * @todo: move actual request to the handlers
     *
     * @param $request
     * @return array
     */
    public function handle($request): array
    {
        $reversedPath = array_reverse($request['path']);
        $action = array_shift($reversedPath);
        $version = array_shift($reversedPath);
        if (!$version) $version = $this->versions[0];

        switch ($action) {
            case 'search':
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $repoSearch = new RepoSearch();
                    $repoSearch->addRepository(new Github());
                    $repoSearch->addRepository(new Gitlab());
                    return $repoSearch->search(urlencode($request['query']['q']));
                } else {
                    throw new \Exception('Invalid request method');
                }
            default:
                throw new \Exception('Invalid request');
        }

    }
}
