<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarToken
{
    /**
     * Verifica se o token UUID está presente no header Authorization.
     * O app mobile envia: Authorization: Bearer <uuid>
     */
    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Token não fornecido.'], 401);
        }

        $token = substr($authHeader, 7); // Remove "Bearer "

        // Valida que é um UUID válido (formato do token emitido no login)
        if (!preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $token)) {
            return response()->json(['message' => 'Token inválido.'], 401);
        }

        return $next($request);
    }
}
