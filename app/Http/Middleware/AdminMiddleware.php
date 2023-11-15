<?php

namespace App\Http\Middleware;


use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminMiddleware extends Middleware
{
    /**
     * @param $request
     * @return string|void|null
     */
    public function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }
}
