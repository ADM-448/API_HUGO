<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — GameReview</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:      #0d0f1a;
            --card:    #141625;
            --border:  rgba(255,255,255,0.08);
            --accent:  #7c5cfc;
            --accent2: #5eead4;
            --danger:  #f43f5e;
            --text:    #e2e8f0;
            --muted:   #8892a4;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            /* fundo com grade sutil */
            background-image:
                radial-gradient(ellipse 80% 60% at 50% -10%, rgba(124,92,252,.25), transparent),
                linear-gradient(rgba(255,255,255,.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.025) 1px, transparent 1px);
            background-size: auto, 40px 40px, 40px 40px;
        }

        .login-wrap {
            width: 100%;
            max-width: 420px;
            padding: 1.5rem;
        }

        .brand {
            text-align: center;
            margin-bottom: 2rem;
        }
        .brand-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: .5rem;
            filter: drop-shadow(0 0 20px rgba(124,92,252,.6));
        }
        .brand-name {
            font-size: 1.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .brand-sub {
            font-size: .85rem;
            color: var(--muted);
            margin-top: .3rem;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 2.2rem;
            box-shadow: 0 25px 60px rgba(0,0,0,.5);
        }

        .form-group { margin-bottom: 1.3rem; }
        label { display: block; font-size: .82rem; font-weight: 600; color: var(--muted); margin-bottom: .5rem; }

        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
            font-size: 1rem; pointer-events: none;
        }
        input {
            width: 100%;
            background: rgba(255,255,255,.04);
            border: 1px solid var(--border);
            border-radius: 10px;
            color: var(--text);
            padding: .8rem 1rem .8rem 2.8rem;
            font-size: .95rem;
            font-family: inherit;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(124,92,252,.2);
        }
        .field-error { color: var(--danger); font-size: .78rem; margin-top: .35rem; }

        .alert-error {
            background: rgba(244,63,94,.12);
            border: 1px solid rgba(244,63,94,.3);
            color: var(--danger);
            border-radius: 10px;
            padding: .85rem 1rem;
            font-size: .88rem;
            font-weight: 500;
            margin-bottom: 1.3rem;
            text-align: center;
        }

        .hint {
            background: rgba(94,234,212,.07);
            border: 1px solid rgba(94,234,212,.2);
            border-radius: 10px;
            padding: .85rem 1rem;
            font-size: .8rem;
            color: var(--muted);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        .hint strong { color: var(--accent2); }

        .btn-login {
            width: 100%;
            background: linear-gradient(135deg, var(--accent), #5b3fd4);
            color: #fff;
            font-weight: 700;
            font-size: 1rem;
            padding: .9rem;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: opacity .2s, transform .15s;
            margin-top: .5rem;
        }
        .btn-login:hover { opacity: .85; transform: translateY(-1px); }
        .btn-login:active { transform: translateY(0); }
    </style>
</head>
<body>

<div class="login-wrap">
    <div class="brand">
        <span class="brand-icon">🎮</span>
        <div class="brand-name">GameReview</div>
        <div class="brand-sub">Biblioteca de Jogos — Painel de Gerenciamento</div>
    </div>

    <div class="card">

        @if($errors->has('credenciais'))
            <div class="alert-error">
                🔒 {{ $errors->first('credenciais') }}
            </div>
        @endif

        <div class="hint">
            <strong>📧 E-mail:</strong> usuario@esoft.com<br>
            <strong>🔑 Senha:</strong> Abc123
        </div>

        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="email">E-mail</label>
                <div class="input-wrap">
                    <span class="input-icon">📧</span>
                    <input type="email" id="email" name="email"
                           placeholder="usuario@esoft.com"
                           value="{{ old('email') }}"
                           autocomplete="email">
                </div>
                @error('email')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <div class="input-wrap">
                    <span class="input-icon">🔑</span>
                    <input type="password" id="password" name="password"
                           placeholder="••••••"
                           autocomplete="current-password">
                </div>
                @error('password')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-login">Entrar →</button>
        </form>
    </div>
</div>

</body>
</html>
