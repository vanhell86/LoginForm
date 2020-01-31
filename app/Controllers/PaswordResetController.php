<?php

namespace App\Controllers;

use Carbon\Carbon;

class PaswordResetController
{
    public function showResetForm()
    {
        return view('auth/reset');
    }

    public function passwordChangeForm(array $params)
    {
        return view('auth/passwordChange', $params);
    }

    public function resetLink()     //for sending reset link to user
    {
        $email = $_POST['email'];

        if(empty($email)){
            flashMessage()->set("You need to enter an email address");
            return redirect('/auth/reset');
        }
        if (!selectDataByEmail($email)) {
            flashMessage()->set("There is no user registered with that email");

            return redirect('/auth/reset');
        }
        $token = generateToken();

        $addToken = database()->update('users',
            ['token' => $token,
                'tokenExpire' => Carbon::now()->add(config('app.token_lifetime'), 'minutes')->format(DATE_ATOM)],
            ['email' => $email]
        );

        if ($addToken) {
            flashMessage()->set("Reset link sent to your email");
            sendMail($email, $token);
            return redirect('/auth/login');
        }
    }

    public function resetPassword(array $params)    // for resetting user password i
    {
        ($userData = database()->get('users', '*', ['token' => $params['token']]));
        if (checkPasswStrength($_POST['newPassword'])) {
            flashMessage()->set('Password should be at least 8 characters in length and should include at least 
            one upper case letter, one number, and one special character.');

            return redirect("/auth/reset/{$params['token']}");
        }
        if ($_POST['newPassword'] !== $_POST['confirmPassword']) {
            flashMessage()->set('Passwords are not equal');

            return redirect("/auth/reset/{$params['token']}");
        }

        $resetPassword = database()->update('users',
            [
                'password' => md5($_POST['newPassword']),
                'token' => null,
                'tokenExpire' => null],
                [
                    'email' => $userData['email']
                ]
        );
        if($resetPassword){
            flashMessage()->set("Password successfully changed");
            return redirect("/auth/login");
        }
        return redirect("/auth/login");
    }
}