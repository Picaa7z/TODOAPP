<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // cek apakah user sudah login
        if (Auth::check()) {
            return $next($request);
        }

        // jika belum login, arahkan ke halaman login dengan pesan
        return redirect('/login')->with('notAllowed', 'Silahkan login terlebih dahulu');
    }
}

