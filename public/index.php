<?php

// TODO Implement user images
// TODO Implement post images
// TODO Implement post delete modal

declare(strict_types=1);

use Core\Router;
use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../src/';

require BASE_PATH . 'functions.php';
require BASE_PATH . '../vendor/autoload.php';
require base_path('bootstrap.php');

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();