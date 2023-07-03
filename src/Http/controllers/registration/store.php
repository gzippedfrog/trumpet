<?php

use Core\App;
use Core\Authenticator;
use Core\User;
use Doctrine\ORM\EntityManager;
use Http\Forms\LoginForm;

$username = isset($_POST['username']) ? (string)$_POST['username'] : null;
$password = isset($_POST['password']) ? (string)$_POST['password'] : null;

$form = LoginForm::validate(['username' => $username, 'password' => $password]);

$entityManager = App::resolve(EntityManager::class);

$user = $entityManager->getRepository(User::class)->findOneBy(['username' => $username]);

if ($user) {
    $form->setError('password', 'User with such username already exists')
        ->throw();
}

$user = new User();
$user->setUsername($username);
$user->setPasswordHash(password_hash($password, PASSWORD_BCRYPT));

$entityManager->persist($user);
$entityManager->flush();

Authenticator::login($user);

redirect('/?page=1');
