<?php


namespace reposearch\RepoSearch\Repositories;


class Gitlab extends AbstractRepository
{

    public function __construct(string $token = null)
    {
        $this->endpoint = 'https://gitlab.com/api/v4/search';
        parent::__construct($token);
    }

    /**
     * Return the query parameters
     *
     * @param $q
     * @return string
     */
    public function queryParameters($q): string
    {
        return "?scope=projects&search=${q}";
    }

    public function search($q, $additionalHeaders = [])
    {
        $privateToken = isset($_ENV['GITLAB_API_TOKEN']) ? $_ENV['GITLAB_API_TOKEN'] : null;
        if ($privateToken) {
            $result = parent::search($q, ["PRIVATE-TOKEN: ${privateToken}"]);
            return json_decode($result, true);
        } else {
            throw new \Exception('Token not supplied!');
        }
    }

}
