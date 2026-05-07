<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JogoWebController;
use App\Http\Controllers\LoginWebController;

// Redireciona raiz
Route::get('/', function () {
    return redirect()->route('jogos.index');
});

// Rotas de Login (públicas)
Route::get('/login',  [LoginWebController::class, 'form'])->name('login.form');
Route::post('/login', [LoginWebController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginWebController::class, 'logout'])->name('logout');

// Rotas protegidas por sessão
Route::middleware('auth.sessao')->group(function () {
    // Rota estática DEVE vir antes das dinâmicas com {id}
    Route::get('/jogos/criar',       [JogoWebController::class, 'create'])->name('jogos.create');

    Route::get('/jogos',             [JogoWebController::class, 'index'])->name('jogos.index');
    Route::get('/jogos/{id}',        [JogoWebController::class, 'show'])->name('jogos.show');
    Route::get('/jogos/{id}/editar', [JogoWebController::class, 'edit'])->name('jogos.edit');
    Route::post('/jogos',            [JogoWebController::class, 'store'])->name('jogos.store');
    Route::put('/jogos/{id}',        [JogoWebController::class, 'update'])->name('jogos.update');
    Route::delete('/jogos/{id}',     [JogoWebController::class, 'destroy'])->name('jogos.destroy');
});
