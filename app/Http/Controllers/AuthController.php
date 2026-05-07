<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Credenciais estáticas conforme especificação
    private const EMAIL_VALIDO = 'usuario@esoft.com';
    private const SENHA_VALIDA = 'Abc123';

    public function login(Request $request)
    {
        $email = $request->input('email');
        $senha = $request->input('password');

        if ($email === self::EMAIL_VALIDO && $senha === self::SENHA_VALIDA) {
            return response()->json([
                'token' => (string) Str::uuid(),
            ], 200);
        }

        return response()->json([
            'message' => 'Credenciais inválidas.',
        ], 401);
    }
}
