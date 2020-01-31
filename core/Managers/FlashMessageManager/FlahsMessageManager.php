<?php

namespace Core\Managers\FlashMessageManager;

class FlahsMessageManager implements FlashMessageInterface
{
    public function set(string $message): void
    {
        $_SESSION['_flashMessage'] = $message;
    }

    /**
     * @return mixed
     */
    public function get(): ?string
    {
        return $_SESSION['_flashMessage'] ?? null;
    }

    public function clear(): void
    {
        unset($_SESSION['_flashMessage']);
    }
}