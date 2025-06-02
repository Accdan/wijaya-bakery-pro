<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        dd(Auth::check());

        if (Auth::check() && Auth::user()->role && Auth::user()->role->role_name === 'admin') {
            return $next($request);
        }

        return redirect()->route('login-admin')->with('error', 'Anda harus login sebagai admin.');
    }
}
