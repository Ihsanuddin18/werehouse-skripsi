<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StaffMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::check() && Auth::user()->usertype == 'staff') {

            return $next($request);
        }

        // JIKA USER COBA BUKA HALAMAN STAFF
        if(Auth::check() && Auth::user()->usertype == 'user') {

            return redirect('/home');
        }

        return redirect('/login');
    }
}