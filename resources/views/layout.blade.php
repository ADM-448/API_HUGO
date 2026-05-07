<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GameReview') — Biblioteca de Jogos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #0d0f1a;
            --surface:   #141625;
            --card:      #1c1f35;
            --border:    rgba(255,255,255,0.08);
            --accent:    #7c5cfc;
            --accent2:   #5eead4;
            --danger:    #f43f5e;
            --success:   #22c55e;
            --text:      #e2e8f0;
            --muted:     #8892a4;
            --radius:    14px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* NAV */
        nav {
            background: rgba(20,22,37,0.85);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
            position: sticky; top: 0; z-index: 100;
            padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 64px;
        }
        .nav-brand {
            font-size: 1.25rem; font-weight: 800;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            text-decoration: none;
        }
        .nav-btn {
            display: inline-flex; align-items: center; gap: .5rem;
            background: linear-gradient(135deg, var(--accent), #5b3fd4);
            color: #fff; font-weight: 600; font-size: .85rem;
            padding: .55rem 1.2rem; border-radius: 8px;
            text-decoration: none; transition: opacity .2s, transform .15s;
        }
        .nav-btn:hover { opacity: .85; transform: translateY(-1px); }

        /* MAIN */
        main { max-width: 1100px; margin: 0 auto; padding: 2.5rem 1.5rem; }

        /* ALERT */
        .alert {
            padding: 1rem 1.4rem; border-radius: var(--radius);
            margin-bottom: 1.5rem; font-weight: 500; font-size: .92rem;
            animation: slideIn .3s ease;
        }
        .alert-success { background: rgba(34,197,94,.15); border: 1px solid rgba(34,197,94,.3); color: var(--success); }
        .alert-error   { background: rgba(244,63,94,.15);  border: 1px solid rgba(244,63,94,.3);  color: var(--danger);  }

        @keyframes slideIn { from { opacity:0; transform: translateY(-8px); } to { opacity:1; transform: translateY(0); } }

        /* CARD */
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
        }
        .card-header {
            padding: 1.5rem 1.8rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .card-header h1 { font-size: 1.3rem; font-weight: 700; }
        .card-body { padding: 1.8rem; }

        /* TABLE */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .9rem; }
        thead tr { background: rgba(124,92,252,.08); }
        th { padding: .85rem 1rem; text-align: left; font-weight: 600; color: var(--muted); text-transform: uppercase; font-size: .75rem; letter-spacing: .05em; }
        td { padding: .85rem 1rem; border-top: 1px solid var(--border); vertical-align: middle; }
        tbody tr { transition: background .15s; }
        tbody tr:hover { background: rgba(255,255,255,.03); }

        /* BADGES */
        .badge {
            display: inline-block; padding: .25rem .7rem; border-radius: 99px;
            font-size: .75rem; font-weight: 600;
        }
        .badge-purple  { background: rgba(124,92,252,.2); color: var(--accent); }
        .badge-teal    { background: rgba(94,234,212,.15); color: var(--accent2); }

        /* NOTA */
        .nota-stars { display: inline-flex; align-items: center; gap: .3rem; font-weight: 700; }
        .nota-bar {
            height: 6px; border-radius: 99px; background: rgba(255,255,255,.1);
            width: 80px; overflow: hidden; display: inline-block; vertical-align: middle; margin-left: .4rem;
        }
        .nota-fill { height: 100%; border-radius: 99px; background: linear-gradient(90deg, var(--accent), var(--accent2)); }

        /* ACTIONS */
        .actions { display: flex; gap: .5rem; }
        .btn-edit {
            display: inline-flex; align-items: center; gap: .3rem;
            background: rgba(124,92,252,.15); color: var(--accent);
            border: 1px solid rgba(124,92,252,.3); border-radius: 8px;
            padding: .4rem .9rem; font-size: .82rem; font-weight: 600;
            text-decoration: none; transition: background .2s, transform .15s;
        }
        .btn-edit:hover { background: rgba(124,92,252,.28); transform: translateY(-1px); }

        .btn-del {
            display: inline-flex; align-items: center;
            background: rgba(244,63,94,.12); color: var(--danger);
            border: 1px solid rgba(244,63,94,.3); border-radius: 8px;
            padding: .4rem .9rem; font-size: .82rem; font-weight: 600;
            cursor: pointer; transition: background .2s, transform .15s;
        }
        .btn-del:hover { background: rgba(244,63,94,.25); transform: translateY(-1px); }

        /* EMPTY */
        .empty-state {
            text-align: center; padding: 4rem 1rem; color: var(--muted);
        }
        .empty-state svg { margin-bottom: 1rem; opacity: .4; }
        .empty-state p { font-size: 1rem; }

        /* FORM */
        .form-group { margin-bottom: 1.4rem; }
        label { display: block; font-size: .85rem; font-weight: 600; color: var(--muted); margin-bottom: .5rem; }
        input[type=text], input[type=number], select, textarea {
            width: 100%; background: var(--surface); border: 1px solid var(--border);
            border-radius: 10px; color: var(--text);
            padding: .75rem 1rem; font-size: .95rem; font-family: inherit;
            transition: border-color .2s, box-shadow .2s;
            outline: none;
        }
        input:focus, select:focus, textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(124,92,252,.2);
        }
        textarea { resize: vertical; min-height: 110px; }
        .field-error { color: var(--danger); font-size: .8rem; margin-top: .3rem; }

        .btn-primary {
            display: inline-flex; align-items: center; gap: .5rem;
            background: linear-gradient(135deg, var(--accent), #5b3fd4);
            color: #fff; font-weight: 700; font-size: .95rem;
            padding: .75rem 2rem; border-radius: 10px; border: none;
            cursor: pointer; transition: opacity .2s, transform .15s;
        }
        .btn-primary:hover { opacity: .85; transform: translateY(-1px); }

        .btn-ghost {
            display: inline-flex; align-items: center; gap: .4rem;
            color: var(--muted); font-weight: 500; font-size: .9rem;
            padding: .75rem 1.5rem; border-radius: 10px; border: 1px solid var(--border);
            text-decoration: none; background: transparent; transition: border-color .2s;
        }
        .btn-ghost:hover { border-color: var(--accent); color: var(--text); }

        .form-actions { display: flex; gap: 1rem; margin-top: 2rem; }

        /* STATS */
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .stat-card {
            background: var(--card); border: 1px solid var(--border); border-radius: var(--radius);
            padding: 1.2rem 1.5rem; display: flex; align-items: center; gap: 1rem;
        }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center; font-size: 1.3rem;
        }
        .stat-icon.purple { background: rgba(124,92,252,.2); }
        .stat-icon.teal   { background: rgba(94,234,212,.15); }
        .stat-icon.pink   { background: rgba(244,63,94,.12); }
        .stat-val { font-size: 1.6rem; font-weight: 800; line-height: 1; }
        .stat-label { font-size: .78rem; color: var(--muted); margin-top: .2rem; }

        /* API PANEL */
        .api-section { margin-top: 2.5rem; }
        .api-section h2 { font-size: 1.1rem; font-weight: 700; margin-bottom: 1rem; color: var(--muted); }
        .endpoint-grid { display: grid; gap: .6rem; }
        .endpoint {
            display: flex; align-items: center; gap: 1rem;
            background: var(--card); border: 1px solid var(--border);
            border-radius: 10px; padding: .7rem 1.2rem; font-size: .85rem;
            font-family: 'Courier New', monospace;
        }
        .method {
            font-weight: 800; min-width: 60px; text-align: center;
            padding: .2rem .5rem; border-radius: 6px; font-size: .78rem;
        }
        .GET    { background: rgba(34,197,94,.15);  color: var(--success); }
        .POST   { background: rgba(124,92,252,.2);  color: var(--accent); }
        .PUT    { background: rgba(234,179,8,.15);  color: #eab308; }
        .DELETE { background: rgba(244,63,94,.15);  color: var(--danger); }

        @media (max-width: 640px) {
            .stats { grid-template-columns: 1fr; }
            .actions { flex-direction: column; }
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('jogos.index') }}" class="nav-brand">🎮 GameReview</a>
    <div style="display:flex; align-items:center; gap:1rem;">
        @hasSection('nav-action')
            @yield('nav-action')
        @else
            <a href="{{ route('jogos.create') }}" class="nav-btn">＋ Novo Jogo</a>
        @endif
        <form action="{{ route('logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" style="
                background: rgba(244,63,94,.12); color: #f43f5e;
                border: 1px solid rgba(244,63,94,.3); border-radius: 8px;
                padding: .5rem 1rem; font-size: .82rem; font-weight: 600;
                cursor: pointer; font-family: inherit; transition: background .2s;">
                Sair 🚪
            </button>
        </form>
    </div>
</nav>

<main>

    @if(session('sucesso'))
        <div class="alert alert-success">✅ {{ session('sucesso') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            ⚠️ Corrija os erros abaixo antes de continuar.
        </div>
    @endif

    @yield('content')
</main>

</body>
</html>
