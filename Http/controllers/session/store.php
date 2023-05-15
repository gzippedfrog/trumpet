<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate([
    'username' => $_POST['username'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt($_POST['username'], $_POST['password']);

if (!$signedIn) {
    $form->setError('password', 'No matching account found for that username and password')
        ->throw();
}

redirect('/');
