<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isAdmin
{

    public function handle($request, Closure $next)
    {
        if (Auth::user()->admin == 'não') {
                return redirect()
                ->route('sistema.main.perfil')
                ->with('user',Auth::user());            }

        return $next($request);
    }
}
