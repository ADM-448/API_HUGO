@extends('layout')

@section('title', $jogo->nome)

@section('nav-action')
    <a href="{{ route('jogos.index') }}" class="btn-ghost">← Voltar</a>
@endsection

@section('content')

<div class="card" style="max-width: 720px; margin: 0 auto;">
    <div class="card-header">
        <div>
            <h1>{{ $jogo->nome }}</h1>
            <span class="badge badge-purple" style="margin-top:.4rem;">{{ $jogo->tipo }}</span>
        </div>
        <div style="text-align:right;">
            <div style="font-size: 2.2rem; font-weight: 800; line-height:1;">
                {{ $jogo->nota }}<span style="font-size:1rem; color:var(--muted)">/10</span>
            </div>
            <div class="nota-bar" style="width:120px; height:8px; margin-top:.4rem;">
                <div class="nota-fill" style="width:{{ $jogo->nota * 10 }}%"></div>
            </div>
        </div>
    </div>

    <div class="card-body">
        <p style="color: var(--muted); font-size:.82rem; margin-bottom:.5rem; font-weight:600; text-transform:uppercase; letter-spacing:.05em;">📝 Review</p>
        <p style="line-height: 1.7; color: var(--text);">{{ $jogo->review }}</p>

        <div style="margin-top: 2rem; padding-top:1.5rem; border-top: 1px solid var(--border); display:flex; gap:1rem; align-items:center;">
            <a href="{{ route('jogos.edit', $jogo->id) }}" class="btn-edit" style="font-size:.9rem; padding:.6rem 1.4rem;">
                ✏️ Editar
            </a>
            <form action="{{ route('jogos.destroy', $jogo->id) }}" method="POST"
                  onsubmit="return confirm('Excluir {{ addslashes($jogo->nome) }}?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-del">🗑️ Excluir</button>
            </form>
            <span style="color:var(--muted); font-size:.78rem; margin-left:auto;">
                ID: #{{ $jogo->id }} · Cadastrado em {{ $jogo->created_at->format('d/m/Y') }}
            </span>
        </div>
    </div>
</div>

@endsection
