@extends('layout')

@section('title', 'Biblioteca de Jogos')

@section('content')

{{-- STATS --}}
<div class="stats">
    <div class="stat-card">
        <div class="stat-icon purple">🎮</div>
        <div>
            <div class="stat-val">{{ $jogos->count() }}</div>
            <div class="stat-label">Jogos cadastrados</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon teal">⭐</div>
        <div>
            <div class="stat-val">
                {{ $jogos->count() > 0 ? number_format($jogos->avg('nota'), 1) : '—' }}
            </div>
            <div class="stat-label">Nota média</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon pink">🏆</div>
        <div>
            <div class="stat-val">
                {{ $jogos->count() > 0 ? $jogos->max('nota') : '—' }}
            </div>
            <div class="stat-label">Nota mais alta</div>
        </div>
    </div>
</div>

{{-- TABELA DE JOGOS --}}
<div class="card">
    <div class="card-header">
        <h1>📋 Jogos & Reviews</h1>
        <a href="{{ route('jogos.create') }}" class="nav-btn">＋ Novo Jogo</a>
    </div>

    <div class="table-wrap">
        @if($jogos->isEmpty())
            <div class="empty-state">
                <svg width="64" height="64" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <p>Nenhum jogo cadastrado ainda.</p>
                <a href="{{ route('jogos.create') }}" class="nav-btn" style="margin-top:1.2rem; display:inline-flex;">
                    ＋ Cadastrar o primeiro jogo
                </a>
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome do Jogo</th>
                        <th>Tipo</th>
                        <th>Nota</th>
                        <th>Review</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jogos as $jogo)
                    <tr>
                        <td style="color: var(--muted); font-size:.8rem;">{{ $jogo->id }}</td>
                        <td>
                            <a href="{{ route('jogos.show', $jogo->id) }}"
                               style="color: var(--text); font-weight:600; text-decoration:none; transition:color .15s;"
                               onmouseover="this.style.color='var(--accent)'"
                               onmouseout="this.style.color='var(--text)'">
                                {{ $jogo->nome }}
                            </a>
                        </td>
                        <td><span class="badge badge-purple">{{ $jogo->tipo }}</span></td>
                        <td>
                            <span class="nota-stars">
                                {{ $jogo->nota }}/10
                                <span class="nota-bar">
                                    <span class="nota-fill" style="width: {{ $jogo->nota * 10 }}%"></span>
                                </span>
                            </span>
                        </td>
                        <td style="max-width:220px; color: var(--muted); font-size:.85rem;">
                            {{ Str::limit($jogo->review, 60) }}
                        </td>
                        <td>
                            <div class="actions">
                                <a href="{{ route('jogos.edit', $jogo->id) }}" class="btn-edit">✏️ Editar</a>
                                <form action="{{ route('jogos.destroy', $jogo->id) }}" method="POST"
                                      onsubmit="return confirm('Tem certeza que quer remover {{ addslashes($jogo->nome) }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-del">🗑️</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

{{-- PAINEL DOS ENDPOINTS DA API --}}
<div class="api-section">
    <h2>🔌 Endpoints da API (testáveis em <code style="color:var(--accent2)">localhost:8000/api</code>)</h2>
    <div class="endpoint-grid">
        <div class="endpoint"><span class="method POST">POST</span> /api/login — Autenticar (usuario@esoft.com / Abc123)</div>
        <div class="endpoint"><span class="method GET">GET</span> /api/jogos — Listar todos os jogos</div>
        <div class="endpoint"><span class="method GET">GET</span> /api/jogos/{id} — Buscar jogo por ID</div>
        <div class="endpoint"><span class="method POST">POST</span> /api/jogos — Cadastrar novo jogo</div>
        <div class="endpoint"><span class="method PUT">PUT</span> /api/jogos/{id} — Atualizar jogo (todos os campos)</div>
        <div class="endpoint"><span class="method DELETE">DELETE</span> /api/jogos/{id} — Remover jogo (204 sem corpo)</div>
    </div>
</div>

@endsection
