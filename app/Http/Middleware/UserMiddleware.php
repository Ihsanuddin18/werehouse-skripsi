<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->usertype == 'user') {

            return $next($request);
        }

        // JIKA STAFF COBA BUKA HALAMAN USER
        if(Auth::check() && Auth::user()->usertype == 'staff') {

            return redirect('/staff/dashboard');
        }

        return redirect('/login');
    }
}