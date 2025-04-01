<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AccessControlMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Verifica se o usuário está autenticado e tem a role especificada
        if (!$request->user() || $request->user()->role !== $role) {
            return response()->json([
                'error' => 'Acesso não autorizado'
            ], 403);
        }

        return $next($request);
    }
}
