<?php

$router->get('/', 'posts/index');
$router->post('/', 'posts/store')->only('auth');

$router->get('/register', 'registration/create')->only('guest');
$router->post('/register', 'registration/store')->only('guest');

$router->get('/login', 'login');
$router->post('/login', 'login');

$router->get('/logout', 'logout')->only('auth');
