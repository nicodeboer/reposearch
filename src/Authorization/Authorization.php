<?php

namespace reposearch\Authorization;

/**
 * Class for handling authorization.
 * @todo: Implement some kind of backend for configuration of black- and whitelisting of IP addresses en tokens.
 *
 * Class Authorization
 * @package reposearch\Authorization
 */
class Authorization
{
    private $token;
    private $remoteIp;

    public function __construct()
    {
        $authorizationHeader = isset($_SERVER['Authorization'])
            ? trim($_SERVER['Authorization'])
            : (isset($_SERVER['HTTP_AUTHORIZATION']) ? trim($_SERVER['HTTP_AUTHORIZATION']) : null);
        $this->token = $authorizationHeader && preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches) ? $matches[1] : null;

        if (!$this->token) {
            $parsedUrl = parse_url($_SERVER['REQUEST_URI']);
            parse_str($parsedUrl['query'], $query);
            if (isset($query['token'])) $this->token = $query['token'];
        }

        $this->remoteIp = $_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP)) {
            $this->remoteIp = $_SERVER['HTTP_CLIENT_IP'];
        }  elseif(isset($_SERVER['HTTP_X_FORWARDED_FOR']) && filter_var($_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP)) {
            $this->remoteIp = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }

    /**
     * Check if client is authorized
     *
     * @return bool
     */
    public function isAuthorized(): bool
    {
        // @todo: Implement some mechanism for IP black-/whitelisting, IP and/or token check etc.
        return true;
    }

}
