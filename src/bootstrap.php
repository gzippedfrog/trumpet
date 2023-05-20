<?php

use Core\App;
use Core\Container;
use Core\Database;

session_start();

$container = new Container();

$container->bind(Database::class, function () {
    $config = parse_ini_file('../config.ini');

    return new Database($config);
});

App::setContainer($container);