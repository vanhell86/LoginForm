<?php


namespace Core\Managers\AuthManager;


use App\Models\User;
use InvalidArgumentException;

class UserAuthManager implements AuthManagerInterface
{
    private $user;

    public function __construct()
    {
        $this->getAuthenticatedUser();
    }

    public function getAuthenticatedUser(): void        //if user in DB create User obj.
    {
        $user = database()->get('users', '*',
            [
                'id' => $_SESSION['authentication_key'] ?? null
            ]
        );
        $this->user = !empty($user) ? User::create($user) : null;
    }

    public function user(): User        //returning user if not null
    {
        if ($this->user === null) {
            throw new InvalidArgumentException("User not authenticated.");
        }
        return $this->user;
    }

    public function check(): bool       //check if user exist
    {
        return $this->user !== null;
    }

    public function loginById(int $id): void    // adding user id to session array
    {
        $_SESSION['authentication_key'] = $id;
    }

    public function logout(): void  // loging out
    {
        $this->user = null;
        unset($_SESSION['authentication_key']);
    }
}