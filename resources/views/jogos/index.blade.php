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
    <h2>🔌 Endpoints da API <span style="font-weight:400; font-size:.9rem;">(clique para expandir)</span></h2>
    <p style="font-size:.82rem; color:var(--muted); margin-bottom:1.2rem;">
      
        Base URL Railway: <code style="color:var(--accent2)">https://web-production-a3ec9.up.railway.app/api</code>
    </p>

    {{-- LOGIN --}}
    <div class="api-card" onclick="toggleApi('login')">
        <div class="api-card-header">
            <span class="method POST">POST</span>
            <span class="api-path">/api/login</span>
            <span class="api-desc">Autenticar e obter token</span>
            <span class="api-chevron" id="chev-login">▶</span>
        </div>
        <div class="api-card-body" id="body-login">
            <div class="api-cols">
                <div>
                    <div class="api-label">📤 Request Body (JSON)</div>
                    <pre class="api-code">{
  "email": "usuario@esoft.com",
  "password": "Abc123"
}</pre>
                </div>
                <div>
                    <div class="api-label">📥 Response <span class="status-ok">200 OK</span></div>
                    <pre class="api-code">{
  "token": "uuid-gerado-aqui"
}</pre>
                </div>
            </div>
        </div>
    </div>

    {{-- GET JOGOS --}}
    <div class="api-card" onclick="toggleApi('get-jogos')">
        <div class="api-card-header">
            <span class="method GET">GET</span>
            <span class="api-path">/api/jogos</span>
            <span class="api-desc">Listar todos os jogos</span>
            <span class="api-chevron" id="chev-get-jogos">▶</span>
        </div>
        <div class="api-card-body" id="body-get-jogos">
            <div class="api-cols">
                <div>
                    <div class="api-label">📤 Request</div>
                    <pre class="api-code">Sem body — acesso direto</pre>
                </div>
                <div>
                    <div class="api-label">📥 Response <span class="status-ok">200 OK</span></div>
                    <pre class="api-code">[
  {
    "id": 1,
    "nome": "The Legend of Zelda",
    "tipo": "Aventura",
    "nota": 10,
    "review": "Um clássico absoluto."
  },
  {
    "id": 2,
    "nome": "FIFA 23",
    "tipo": "Esporte",
    "nota": 7,
    "review": "Bom para jogar com amigos."
  }
]</pre>
                </div>
            </div>
        </div>
    </div>

    {{-- GET JOGOS/{ID} --}}
    <div class="api-card" onclick="toggleApi('get-jogo-id')">
        <div class="api-card-header">
            <span class="method GET">GET</span>
            <span class="api-path">/api/jogos/{id}</span>
            <span class="api-desc">Buscar jogo por ID</span>
            <span class="api-chevron" id="chev-get-jogo-id">▶</span>
        </div>
        <div class="api-card-body" id="body-get-jogo-id">
            <div class="api-cols">
                <div>
                    <div class="api-label">📤 Request</div>
                    <pre class="api-code">GET /api/jogos/1
Sem body</pre>
                </div>
                <div>
                    <div class="api-label">📥 Response <span class="status-ok">200 OK</span> / <span class="status-err">404</span></div>
                    <pre class="api-code">{
  "id": 1,
  "nome": "The Legend of Zelda",
  "tipo": "Aventura",
  "nota": 10,
  "review": "Um clássico absoluto."
}

// 404:
{ "message": "Jogo não encontrado." }</pre>
                </div>
            </div>
        </div>
    </div>

    {{-- POST JOGOS --}}
    <div class="api-card" onclick="toggleApi('post-jogos')">
        <div class="api-card-header">
            <span class="method POST">POST</span>
            <span class="api-path">/api/jogos</span>
            <span class="api-desc">Cadastrar novo jogo</span>
            <span class="api-chevron" id="chev-post-jogos">▶</span>
        </div>
        <div class="api-card-body" id="body-post-jogos">
            <div class="api-cols">
                <div>
                    <div class="api-label">📤 Request Body (JSON)</div>
                    <pre class="api-code">{
  "nome": "God of War",
  "tipo": "Ação",
  "nota": 10,
  "review": "Épico do início ao fim."
}</pre>
                    <div class="api-label" style="margin-top:.8rem">⚠️ Campos obrigatórios</div>
                    <pre class="api-code">nome (string), tipo (string),
nota (int 0-10), review (string)</pre>
                </div>
                <div>
                    <div class="api-label">📥 Response <span class="status-ok">201 Created</span> / <span class="status-err">422</span></div>
                    <pre class="api-code">{
  "id": 3,
  "nome": "God of War",
  "tipo": "Ação",
  "nota": 10,
  "review": "Épico do início ao fim."
}

// 422:
{
  "message": "Dados inválidos.",
  "errors": { "nome": ["required"] }
}</pre>
                </div>
            </div>
        </div>
    </div>

    {{-- PUT JOGOS/{ID} --}}
    <div class="api-card" onclick="toggleApi('put-jogos')">
        <div class="api-card-header">
            <span class="method PUT">PUT</span>
            <span class="api-path">/api/jogos/{id}</span>
            <span class="api-desc">Atualizar todos os dados do jogo</span>
            <span class="api-chevron" id="chev-put-jogos">▶</span>
        </div>
        <div class="api-card-body" id="body-put-jogos">
            <div class="api-cols">
                <div>
                    <div class="api-label">📤 Request Body (JSON)</div>
                    <pre class="api-code">{
  "nome": "Zelda: Tears of Kingdom",
  "tipo": "Aventura",
  "nota": 10,
  "review": "Melhor jogo da geração."
}</pre>
                </div>
                <div>
                    <div class="api-label">📥 Response <span class="status-ok">200 OK</span> / <span class="status-err">404</span></div>
                    <pre class="api-code">{
  "id": 1,
  "nome": "Zelda: Tears of Kingdom",
  "tipo": "Aventura",
  "nota": 10,
  "review": "Melhor jogo da geração."
}

// 404:
{ "message": "Jogo não encontrado." }</pre>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE JOGOS/{ID} --}}
    <div class="api-card" onclick="toggleApi('del-jogos')">
        <div class="api-card-header">
            <span class="method DELETE">DELETE</span>
            <span class="api-path">/api/jogos/{id}</span>
            <span class="api-desc">Remover um jogo</span>
            <span class="api-chevron" id="chev-del-jogos">▶</span>
        </div>
        <div class="api-card-body" id="body-del-jogos">
            <div class="api-cols">
                <div>
                    <div class="api-label">📤 Request</div>
                    <pre class="api-code">DELETE /api/jogos/1
Sem body</pre>
                </div>
                <div>
                    <div class="api-label">📥 Response <span class="status-ok">204 No Content</span> / <span class="status-err">404</span></div>
                    <pre class="api-code">// 204: sem corpo na resposta

// 404:
{ "message": "Jogo não encontrado." }</pre>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.api-section h2 { font-size: 1.1rem; font-weight: 700; margin-bottom: .4rem; color: var(--text); }
.api-card {
    background: var(--card); border: 1px solid var(--border);
    border-radius: 10px; margin-bottom: .6rem; cursor: pointer;
    transition: border-color .2s;
}
.api-card:hover { border-color: rgba(124,92,252,.4); }
.api-card-header {
    display: flex; align-items: center; gap: 1rem;
    padding: .8rem 1.2rem; font-family: 'Courier New', monospace; font-size: .85rem;
}
.api-path { color: var(--text); font-weight: 600; }
.api-desc { color: var(--muted); font-size: .82rem; font-family: 'Inter', sans-serif; flex: 1; }
.api-chevron { color: var(--muted); font-size: .75rem; transition: transform .2s; }
.api-chevron.open { transform: rotate(90deg); color: var(--accent); }
.api-card-body {
    display: none; padding: 1.2rem 1.4rem;
    border-top: 1px solid var(--border);
}
.api-card-body.open { display: block; }
.api-cols { display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem; }
.api-label { font-size: .75rem; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing:.05em; margin-bottom: .5rem; }
.api-code {
    background: #0a0c15; border: 1px solid var(--border);
    border-radius: 8px; padding: .9rem 1rem;
    font-family: 'Courier New', monospace; font-size: .8rem;
    color: var(--accent2); line-height: 1.6; white-space: pre-wrap;
}
.status-ok  { color: #22c55e; font-weight: 700; }
.status-err { color: #f43f5e; font-weight: 700; }
@media(max-width:640px) { .api-cols { grid-template-columns: 1fr; } }
</style>

<script>
function toggleApi(id) {
    const body = document.getElementById('body-' + id);
    const chev = document.getElementById('chev-' + id);
    body.classList.toggle('open');
    chev.classList.toggle('open');
}
</script>

@endsection
