<?php

use Core\App;
use Core\Container;
use Core\Database;

session_start();

$container = new Container();

$container->bind(Database::class, function () {
    $config = require base_path('../config.php');

    return new Database($config);
});

App::setContainer($container);