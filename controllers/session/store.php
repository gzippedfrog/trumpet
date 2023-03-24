<?php

use Core\App;
use Core\Database;

$username = $_POST['username'];
$password = $_POST['password'];

$db = App::resolve(Database::class);

$stmt = 'SELECT * 
         FROM users 
         WHERE username = :username';

$user = $db->query($stmt, compact('username'))->fetch();

if (!empty($user) && password_verify($_POST['password'], $user['password'])) {
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    header('Location: /');
    exit();
}

$errors = ['password' => "Couldn't find user with such username/password"];

view('session/create', compact('username', 'errors'));
