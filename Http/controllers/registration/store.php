<?php

use Core\App;
use Core\Database;
use Http\Forms\LoginForm;


$form = LoginForm::validate([
    'username' => $_POST['username'],
    'password' => $_POST['password']
]);

$db = App::resolve(Database::class);

$stmt = 'SELECT * FROM users WHERE username = :username';

$user = $db->query($stmt, ['username' => $_POST['username']])->fetch();

if ($user) {
    $form->setError('password', 'User with such username already exists')->throw();
}

$stmt = 'INSERT INTO users (username, password)
             VALUES (:username, :password)';

$db->query(
    $stmt,
    [
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT)
    ]
);

$_SESSION['id'] = (int) $db->connection->lastInsertId();
$_SESSION['username'] = $_POST['username'];

redirect('/');
