<?php


namespace App\Controllers;


use App\Middlewares\RedirectIfAuthenticated;
use Carbon\Carbon;

class SignUpController
{

    /**
     * SignUpController constructor.
     */
    public function __construct()
    {
        (new RedirectIfAuthenticated())->handle();
    }

    public function signUp()        // for signup
    {

        if(empty($_POST['name'])){                                      // validating field
            flashMessage()->set('You need to enter your name');
            return redirect('/auth/signup');
        }
        if(empty($_POST['email'])){
            flashMessage()->set('You need to enter your email');
            return redirect('/auth/signup');
        }
        if (selectDataByEmail($_POST['email'])) {
            flashMessage()->set('User already exist with that email');

            return redirect('/auth/signup');
        }
        if (checkPasswStrength($_POST['password'])) {
            flashMessage()->set('Password should be at least 8 characters in length and should include at least 
            one upper case letter, one number, and one special character.');

            return redirect('/auth/signup');
        }
        if ($_POST['password'] !== $_POST['confirm_password']) {
            flashMessage()->set('Passwords are not equal');

            return redirect('/auth/signup');
        }

        $user = database()->insert('users',             //inserting new user into DB
            [
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => md5($_POST['password']),
                'created_at' => Carbon::now()->format(Carbon::ATOM)
            ]);

        sendMail($_POST['email'],'',true);


        return redirect('/auth/login');
    }

    public function showSignUpForm()
    {
        return view('auth/signUp');
    }

}