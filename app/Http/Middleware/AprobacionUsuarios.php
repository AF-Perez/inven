<?php

namespace App\Http\Middleware;

use Closure;

class AprobacionUsuarios
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->user()->ha_establecido_contrasenia)
        {
            return redirect()->route('aprobacion');
        }
        return $next($request);
    }
}
