<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$username = isset($_POST['username']) ? (string)$_POST['username'] : null;
$password = isset($_POST['password']) ? (string)$_POST['password'] : null;

$form = LoginForm::validate(['username' => $username, 'password' => $password]);

$signedIn = Authenticator::attempt($username, $password);

if (!$signedIn) {
    $form->setError('password', 'No matching account found for that username and password')
        ->throw();
}

redirect('/?page=1');
