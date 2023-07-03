<?php

namespace Core\Middleware;

class Auth
{
    public static function handle(): void
    {
        if (!isset($_SESSION['id'])) {
            redirect('/');
        }
    }
}
