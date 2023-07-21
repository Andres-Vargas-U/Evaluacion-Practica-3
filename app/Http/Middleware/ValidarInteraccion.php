<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidarInteraccion
{
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'perro_interesado_id' => 'required|exists:perros,id',
            'perro_candidato_id' => 'required|exists:perros,id',
            'preferencia' => 'required|in:aceptado,rechazado',
        ]);

        return $next($request);
    }
}
