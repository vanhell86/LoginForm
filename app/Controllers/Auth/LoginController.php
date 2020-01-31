<?php

namespace App\Controllers\Auth;

use App\Middlewares\RedirectIfAuthenticated;


class LoginController
{

    public function __construct()
    {
        (new RedirectIfAuthenticated())->handle();
    }

    public function showLoginForm()
    {
        return view('auth/login');
    }

    public function login()
    {

        $user = database()->get('users', '*',
            [
                'email' => $_POST['email'],
                'password' => md5($_POST['password'])
            ]
        );

        if (empty($user)) {
            flashMessage()->set('Invalid username or password');
            return redirect('/auth/login');
        }

        auth()->loginById($user['id']);

        return redirect('/');
    }


    private function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }
}