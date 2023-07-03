<?php

namespace Core\Middleware;

class Guest
{
    public static function handle(): void
    {
        if (isset($_SESSION['id'])) {
            redirect('/');
        }
    }
}
