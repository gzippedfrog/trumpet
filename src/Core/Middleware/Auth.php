<?php

namespace Core\Middleware;

class Auth
{
    /**
     * @return void
     */
    public static function handle(): void
    {
        if (!isset($_SESSION['id'])) {
            redirect('/');
        }
    }
}
