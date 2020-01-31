<?php

namespace Core\Managers\SessionManager;

interface SessionManagerInterface
{
    public function update(): void;

    public function hasExpired(): bool;

    public function invalidate(): void;
}