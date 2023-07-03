<?php

namespace Core;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\NotSupported;

class Authenticator
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws NotSupported
     */
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

    /**
     * @param User $user
     * @return void
     */
    public static function login(User $user): void
    {
        Session::put('id', $user->getId());
        Session::put('username', $user->getUsername());
    }

    /**
     * @return void
     */
    public static function logout(): void
    {
        Session::destroy();
    }
}
