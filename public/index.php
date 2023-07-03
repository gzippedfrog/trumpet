<?php

// TODO Implement user images
// ✓ TODO Implement post images
// ✓ TODO Implement pagination (maybe)
// ✓ TODO Add type declarations
// ✓ TODO Add setters & getters

declare(strict_types=1);

use Core\Router;
use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__ . '/../src/';

require BASE_PATH . 'bootstrap.php';

$router = new Router();
$routes = require base_path('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    redirect($router->previousUrl());
}

Session::unflash();