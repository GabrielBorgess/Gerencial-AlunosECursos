<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    // Relatório 1: Quantidade de alunos
    public function alunosPorCurso()
    {
        $dados = Curso::withCount('alunos')->get();

        return view('relatorios.alunos_por_curso', compact('dados'));
    }

    // Relatório 2: Listagem de alunos
    public function listagemAlunos()
    {
        $cursos = Curso::with(['alunos' => function ($query) {
            $query->orderBy('nome');
        }])->get();

        return view('relatorios.listagem_alunos', compact('cursos'));
    }
}

