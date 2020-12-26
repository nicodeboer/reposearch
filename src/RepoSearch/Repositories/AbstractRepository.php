<?php

namespace reposearch\RepoSearch\Repositories;

abstract class AbstractRepository implements RepositoryInterface
{
    protected $endpoint;
    protected $token;

    public function __construct(string $token = null)
    {
        $this->token = $token;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function setEndpoint(string $url)
    {
        $this->endpoint = $url;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    public function queryParameters($q)
    {
        return "?q=${q}";
    }

    public function search($q, $additionalHeaders = [])
    {
        $curl = curl_init();

        $httpHeaders = ['Content-Type: application/json'];
        if ($this->token) $httpHeaders[] = sprintf("Authorization: Bearer %s", $this->token);
        $httpHeaders = array_merge($httpHeaders, $additionalHeaders);

        curl_setopt($curl, CURLOPT_URL, $this->endpoint . $this->queryParameters($q));
        /**
         * Some repository API's expect a real user agent
         */
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $httpHeaders);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        /**
         * @todo: error handling?
         */

        curl_close($curl);

        return $result;
    }
}
