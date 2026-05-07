<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarSessao
{
    public function handle(Request $request, Closure $next)
    {
        if (!session('logado')) {
            return redirect()->route('login.form')
                             ->with('info', 'Faça login para continuar.');
        }
        return $next($request);
    }
}
