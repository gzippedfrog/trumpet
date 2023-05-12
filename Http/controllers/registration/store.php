<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;

$username = $_POST['username'];
$password = $_POST['password'];

$form = new LoginForm();

if (!$form->validate($username, $password)) {
    $errors = $form->getErrors();

    return view(
        'registration/create',
        compact('username', 'password', 'errors')
    );
}

$db = App::resolve(Database::class);

$stmt = 'INSERT INTO users (username, password)
         VALUES (:username, :password)';

$db->query(
    $stmt,
    [
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]
);

$_SESSION['id'] = (int) $db->connection->lastInsertId();
$_SESSION['username'] = $username;

header('Location: /');
exit();
