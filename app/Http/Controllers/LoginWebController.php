<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginWebController extends Controller
{
    private const EMAIL_VALIDO = 'usuario@esoft.com';
    private const SENHA_VALIDA = 'Abc123';

    public function form()
    {
        // Se já estiver logado, vai direto pra lista
        if (session('logado')) {
            return redirect()->route('jogos.index');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Informe o e-mail.',
            'email.email'       => 'E-mail inválido.',
            'password.required' => 'Informe a senha.',
        ]);

        if (
            $request->email    === self::EMAIL_VALIDO &&
            $request->password === self::SENHA_VALIDA
        ) {
            session(['logado' => true, 'usuario_email' => $request->email]);
            return redirect()->route('jogos.index');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['credenciais' => 'E-mail ou senha inválidos.']);
    }

    public function logout()
    {
        session()->forget(['logado', 'usuario_email']);
        return redirect()->route('login.form');
    }
}
