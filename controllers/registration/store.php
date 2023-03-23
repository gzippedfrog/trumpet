<?php

use Core\App;
use Core\Database;
use Core\Validator;

$username = $_POST['username'];
$password = $_POST['password'];

$errors = [];

if (!Validator::string($username, 4, 10)) {
    $errors['username'] = 'Please enter a username between 4 and 10 characters';
}

if (!Validator::string($password, 8, 50)) {
    $errors['password'] = 'Please enter a password between 8 and 50 characters';
}

if (!empty($errors)) {
    return view('registration/create', compact('errors', 'username', 'password'));
}

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO users (username, password)
         VALUES (:username, :password)';

$db->query($stmt, compact('username', 'password'));

$_SESSION['id'] = (int) $db->connection->lastInsertId();
$_SESSION['username'] = $username;

header('Location: /');
exit();
