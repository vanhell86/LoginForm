<?php

namespace Core\Managers\SessionManager;

class SessionManager
{
    public static function get(): SessionManagerInterface
    {
        return new CurrentSessionManager(time());
    }
}