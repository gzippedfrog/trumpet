<?php

require BASE_PATH . "functions.php";
require base_path("../vendor/autoload.php");

use Core\App;
use Core\Container;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

session_start();

$container = new Container();

$container->bind(EntityManager::class, function () {
    $paths = [BASE_PATH];
    $isDevMode = true;

    $dbParams = [
        'driver' => 'pdo_mysql',
        'user' => 'root',
        'password' => '',
        'dbname' => 'trumpet_test',
    ];

    $config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
    $connection = DriverManager::getConnection($dbParams, $config);

    return new EntityManager($connection, $config);
});

App::setContainer($container);