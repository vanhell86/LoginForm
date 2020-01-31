<?php

namespace App\Controllers\Auth;

use App\Middlewares\Authorized;

class LogoutController
{

    /**
     * LogoutController constructor.
     */
    public function __construct()
    {
        (new Authorized())->handle();
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

}