<?php

require_once('core/ApiException.php');
require_once('core/Router.php');
require_once('core/BaseController.php');
require_once('Controller.php');

use \app\Router;
use \app\core\ApiException;

$config = require_once('config.php');

try {
    $response = (new Router($config))->fetch($_GET);
} catch (ApiException $e) {
    $response = ['error' => $e->getMessage()];
} catch (\Exception $e) {
    $response = ['error' => 'Unknown error'];
    @file_put_contents(
        './logs/errors.log',
        'Code: ' . $e->getCode() . ";\t" .
        'error: ' . $e->getMessage() . PHP_EOL .
        'File: ' . $e->getFile() . PHP_EOL .
        'Line: ' . $e->getLine() . PHP_EOL .
        $e->getTraceAsString() . PHP_EOL,
        FILE_APPEND
    );
}

// echos the array as JSON
header('Content-Type: application/json');
echo json_encode($response);
