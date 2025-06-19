<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CursoApiController;
use App\Http\Controllers\Api\AlunoApiController;

Route::apiResource('cursos', CursoApiController::class);
Route::apiResource('alunos', AlunoApiController::class);