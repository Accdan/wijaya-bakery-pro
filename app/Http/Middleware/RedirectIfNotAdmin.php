<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfNotAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect('/login-admin');
        }

        // Cek role ID admin
        if (Auth::user()->role_id !== '6ef8fcb8-7bd8-4279-b26b-b06b20b78043') {
            Auth::logout();
            return redirect('/login-admin')->with('error', 'Anda tidak memiliki akses admin.');
        }

        return $next($request);
    }
}
