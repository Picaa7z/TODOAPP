<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // cek kalau di authnya udah ada history login, dia gabole masuk ke login lg bakal di redirect lagi ke todo
        if (Auth::check()) {
            return redirect()->route('todo.index')->with('notAllowed', 'Anda sudah login!');
        }

        // kalau gaada history login, baru boleh next ke login
        return $next($request);
    }
}

