<?php

namespace App\Middlewares;

class RedirectIfAuthenticated
{
    public function handle()        // if authorized then redirect to home
    {
        if (auth()->check()) {
            return redirect('/');
        }
    }
}
