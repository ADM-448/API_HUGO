@extends('layout')

@section('title', 'Novo Jogo')

@section('nav-action')
    <a href="{{ route('jogos.index') }}" class="btn-ghost">← Voltar</a>
@endsection

@section('content')

<div class="card" style="max-width: 680px; margin: 0 auto;">
    <div class="card-header">
        <h1>🎮 Cadastrar Novo Jogo</h1>
    </div>
    <div class="card-body">

        <form action="{{ route('jogos.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome do Jogo</label>
                <input type="text" id="nome" name="nome"
                       placeholder="Ex: The Legend of Zelda: Tears of the Kingdom"
                       value="{{ old('nome') }}">
                @error('nome')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo">Tipo / Gênero</label>
                <select id="tipo" name="tipo">
                    <option value="">— Selecione o tipo —</option>
                    @foreach(['Ação', 'Aventura', 'RPG', 'Estratégia', 'Esportes', 'Corrida', 'Plataforma', 'Terror', 'Simulação', 'Luta', 'Puzzle', 'FPS', 'MMORPG', 'Outro'] as $tipo)
                        <option value="{{ $tipo }}" {{ old('tipo') == $tipo ? 'selected' : '' }}>
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
                       min="0" max="10" placeholder="Ex: 9"
                       value="{{ old('nota') }}">
                @error('nota')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="review">Review / Opinião</label>
                <textarea id="review" name="review"
                          placeholder="Escreva sua review detalhada do jogo...">{{ old('review') }}</textarea>
                @error('review')
                    <div class="field-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">💾 Salvar Jogo</button>
                <a href="{{ route('jogos.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>

    </div>
</div>

@endsection
