<?php

namespace Core\Managers\AuthManager;

class AuthManager
{
    public static $instance;

    public static function get(): AuthManagerInterface
    {
        if (self::$instance === null) {
            self::$instance = new UserAuthManager();
        }
        return self::$instance;
    }
}