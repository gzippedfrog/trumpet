<?php

namespace Core;

class Authenticator
{
    public function attempt($username, $password)
    {
        $db = App::resolve(Database::class);

        $stmt = 'SELECT * FROM users WHERE username = :username';

        $user = $db->query($stmt, ['username' => $username])->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $this->login($user);

            return true;
        }

        return false;
    }

    protected function login($user)
    {
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    }

    public function logout()
    {
        Session::destroy();
    }
}
