@extends('layout')

@section('title', 'Editar: ' . $jogo->nome)

@section('nav-action')
    <a href="{{ route('jogos.index') }}" class="btn-ghost">← Voltar</a>
@endsection

@section('content')

<div class="card" style="max-width: 680px; margin: 0 auto;">
    <div class="card-header">
        <h1>✏️ Editar Jogo</h1>
        <span class="badge badge-teal">#{{ $jogo->id }}</span>
    </div>
    <div class="card-body">

        <form action="{{ route('jogos.update', $jogo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome do Jogo</label>
                <input type="text" id="nome" name="nome"
                       placeholder="Ex: God of War Ragnarök"
                       value="{{ old('nome', $jogo->nome) }}">
                @error('nome')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo">Tipo / Gênero</label>
                <select id="tipo" name="tipo">
                    <option value="">— Selecione o tipo —</option>
                    @foreach(['Ação', 'Aventura', 'RPG', 'Estratégia', 'Esportes', 'Corrida', 'Plataforma', 'Terror', 'Simulação', 'Luta', 'Puzzle', 'FPS', 'MMORPG', 'Outro'] as $tipo)
                        <option value="{{ $tipo }}"
                            {{ old('tipo', $jogo->tipo) == $tipo ? 'selected' : '' }}>
                            {{ $tipo }}
                        </option>
                    @endforeach
                </select>
                @error('tipo')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nota">Nota (0 a 10)</label>
                <input type="number" id="nota" name="nota"
                       min="0" max="10"
                       value="{{ old('nota', $jogo->nota) }}">
                @error('nota')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="review">Review / Opinião</label>
                <textarea id="review" name="review"
                          placeholder="Escreva sua review detalhada do jogo...">{{ old('review', $jogo->review) }}</textarea>
                @error('review')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Salvar Alterações</button>
                <a href="{{ route('jogos.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>

        {{-- ZONA DE PERIGO --}}
        <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--border);">
            <p style="font-size:.82rem; color: var(--muted); margin-bottom:.8rem;">⚠️ Zona de perigo</p>
            <form action="{{ route('jogos.destroy', $jogo->id) }}" method="POST"
                  onsubmit="return confirm('Tem certeza que quer EXCLUIR {{ addslashes($jogo->nome) }}? Esta ação não pode ser desfeita.')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-del" style="font-size:.85rem; padding:.5rem 1.2rem;">
                    🗑️ Excluir este jogo permanentemente
                </button>
            </form>
        </div>

    </div>
</div>

@endsection
