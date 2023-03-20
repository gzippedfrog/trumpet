<?php

use Core\App;
use Core\Database;

$username = $_POST['username'];
$password = $_POST['password'];

$db = App::resolve(Database::class);

$stmt = 'SELECT * 
         FROM users 
         WHERE username = :username
         AND password = :password';

$user = $db->query($stmt, compact('username', 'password'))->fetch();

if (!empty($user)) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];

    header('Location: /');
    exit();
}

$errors = ['password' => "Couldn't find user with such username/password"];

view('login', compact('username', 'errors'));
