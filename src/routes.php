<?php
/** @var $router */

$router->get('/', 'posts/index');
$router->get('/posts/create', 'posts/create')->only('auth');
$router->post('/posts', 'posts/store')->only('auth');
$router->get('/posts/edit', 'posts/edit')->only('auth');
$router->patch('/posts', 'posts/update')->only('auth');
$router->delete('/posts', 'posts/destroy')->only('auth');

$router->get('/register', 'registration/create')->only('guest');
$router->post('/register', 'registration/store')->only('guest');

$router->get('/login', 'session/create')->only('guest');
$router->post('/session', 'session/store')->only('guest');
$router->delete('/session', 'session/destroy')->only('auth');

$router->post('/like', 'like/store')->only('auth');
$router->delete('/like', 'like/destroy')->only('auth');
