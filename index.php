<?php

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->addPsr4('Div\\', __DIR__);

$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('logs/app.log', Monolog\Logger::WARNING));
$log->addWarning('Starting Repo Search');

$response_code = 200;
$response = [];

header('Content-Type: application/json', true, $response_code);
echo json_encode($response);
