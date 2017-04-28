<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next) {

        $usuario = Auth::user();
        if (!$usuario) {
            return redirect('/');
        } else if (!$usuario->isUsuario()) {
            return redirect('/site/negado');
        }
        return $next($request);
    }
}
