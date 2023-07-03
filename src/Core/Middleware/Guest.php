<?php

namespace Core\Middleware;

class Guest
{
    /**
     * @return void
     */
    public static function handle(): void
    {
        if (isset($_SESSION['id'])) {
            redirect('/');
        }
    }
}
