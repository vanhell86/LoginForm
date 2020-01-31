<?php


namespace App\Middlewares;


class Authorized
{
    public function handle()        // if not authorized then redirect to home
    {
        if (!auth()->check()) {
            return redirect('/');
        }
    }
}