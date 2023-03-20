<?php

$router->get('/', 'index');
$router->post('/', 'posts/store')->only('auth');

$router->get('/register', 'registration/create')->only('guest');
$router->post('/register', 'registration/store')->only('guest');

$router->get('/login', 'show-login-form')->only('guest');
$router->post('/login', 'login')->only('guest');

$router->get('/logout', 'logout')->only('auth');

$router->post('/like', 'like/store')->only('auth');
$router->delete('/like', 'like/destroy')->only('auth');
