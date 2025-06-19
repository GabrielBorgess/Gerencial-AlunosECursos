<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\RelatorioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('cursos', CursoController::class);
    Route::resource('alunos', AlunoController::class);
    Route::get('/relatorios/alunos-por-curso', [RelatorioController::class, 'alunosPorCurso'])->name('relatorios.alunos_por_curso');
    Route::get('/relatorios/listagem-alunos', [RelatorioController::class, 'listagemAlunos'])->name('relatorios.listagem_alunos');
});

require __DIR__.'/auth.php';
