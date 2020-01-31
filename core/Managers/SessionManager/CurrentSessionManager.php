<?php

namespace Core\Managers\SessionManager;

class CurrentSessionManager implements SessionManagerInterface
{
    private $currentTime;
    private $lifetime;

    /**
     * SessionManager constructor.
     * @param $currentTime
     */
    public function __construct($currentTime)
    {
        $this->currentTime = $currentTime;
        $this->lifetime = config('app.session_lifetime');   // setting session time
    }

    public function update(): void      // updating session time if active
    {
        $_SESSION['__lifetime'] = time();
    }

    public function hasExpired(): bool      // checking if session not expired
    {
        $activeSessionTime = $_SESSION['__lifetime'] ?? null;

        if (!$activeSessionTime) {
            return true;
        }

        return ($this->currentTime - $activeSessionTime) > $this->lifetime;
    }

    public function invalidate(): void      //logout if session
    {
        auth()->logout();
    }
}