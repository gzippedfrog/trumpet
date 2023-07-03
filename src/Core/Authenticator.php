<?php

namespace Core;

use Doctrine\ORM\EntityManager;

class Authenticator
{
    public static function attempt(string $username, string $password): bool
    {
        $entityManager = App::resolve(EntityManager::class);

        $user = $entityManager->getRepository(User::class)
            ->findOneBy(['username' => $username]);

        if ($user && password_verify($password, $user->getPasswordHash())) {
            self::login($user);

            return true;
        }

        return false;
    }

    protected static function login(User $user): void
    {
        Session::put('id', $user->getId());
        Session::put('username', $user->getUsername());
    }

    public static function logout(): void
    {
        Session::destroy();
    }
}
