<?php

namespace myDelivery\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::check() && Auth::user()->role == 'Administrador') {
            redirect()->to('admin');
        } else {
            return redirect()->to('auth/login');
        }


        return $next($request);
    }

}
