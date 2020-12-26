<?php


namespace reposearch\RepoSearch\Repositories;


class Github extends AbstractRepository
{

    public function __construct(string $token = null)
    {
        $this->endpoint = 'https://api.github.com/search/repositories';
        parent::__construct($token);
    }

    public function search($q, $additionalHeaders = [])
    {
        $result = parent::search($q, $additionalHeaders);
        $json = json_decode($result, true);
        return $json['items'];
    }

}
