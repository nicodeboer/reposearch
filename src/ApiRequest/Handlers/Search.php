<?php

namespace reposearch\ApiRequest;

use reposearch\RepoSearch\Repositories\Github;
use reposearch\RepoSearch\Repositories\Gitlab;

class Search extends AbstractApiHandler
{
    public function handle($request): array
    {
        $action = array_reverse($request['path'])[0];
        switch ($action) {
            case 'search':
                if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                    $repoQuery = new \reposearch\RepoSearch\Search();
                    $repoQuery->addRepository(new Github());
                    $repoQuery->addRepository(new Gitlab());
                    return $repoQuery->search($request['query']['q']);
                } else {
                    throw new \Exception('Invalid request method');
                }
            default:
                throw new \Exception('Invalid request');
        }

    }
}
