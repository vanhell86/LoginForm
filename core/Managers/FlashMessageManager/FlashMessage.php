<?php

namespace Core\Managers\FlashMessageManager;

class FlashMessage
{
    public static function get(): FlashMessageInterface
    {
        return new FlahsMessageManager();
    }
}