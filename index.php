<?php

use reposearch\Authorization\Authorization;
use reposearch\ApiRequest\Request;

/**
 * Send response with code and exit
 *
 * @param $response
 * @param $responseCode
 */
function sendResponse(array $response = [], int $responseCode = 200) {
    header('Content-Type: application/json', true, $responseCode);
    echo json_encode($response);
    exit;
}

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('reposearch\\', __DIR__);

/**
 * Load settings into environment variables
 */
try {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
} catch (\Exception $e) {
    sendResponse(['status' => 'error', 'message' => 'Configuration error!'], 500);
}

/**
 * Authorization check
 */
$auth = new Authorization();
if (!$auth->isAuthorized()) {
    sendResponse(['status' => 'error', 'message' => 'Not authorized!'], 401);
}

/**
 * One of: GET (retrieve), POST (create), PUT [PATCH] ([partial] update), DELETE (delete)
 */
$requestMethod = $_SERVER['REQUEST_METHOD'];

$parsedUrl = parse_url($_SERVER['REQUEST_URI']);
$path = array_slice(explode('/', $parsedUrl['path']), 1);
parse_str($parsedUrl['query'], $query);

$request = [
    'method' => $requestMethod,
    'path' => $path,
    'query' => $query
];

$apiRequest = new Request();
try {
    $response = $apiRequest->handle($request);
    sendResponse($response, 200);
} catch (\Exception $e) {
    sendResponse(['status' => 'error', 'message' => 'Handling request failed!'], 500);
}
