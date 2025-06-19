<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    // Relatório 1: Quantidade de alunos
    public function alunosPorCurso(Request $request)
    {
        $porPagina = $request->input('por_pagina', 10);
        $busca = $request->input('busca');

        $query = Curso::withCount('alunos')->orderBy('nome');

        if ($busca) {
            $query->where('nome', 'like', '%' . $busca . '%');
        }

        $dados = $query->paginate($porPagina)->withQueryString();

        return view('relatorios.alunos-por-curso', compact('dados', 'porPagina', 'busca'));
    }

    // Relatório 2: Listagem de alunos
    public function listagemAlunos(Request $request)
    {
        $porPagina = $request->input('por_pagina', 5);
        $busca = $request->input('busca');

        $query = Curso::with(['alunos' => function ($query) {
            $query->orderBy('nome');
        }])->orderBy('nome');

        if ($busca) {
            $query->where('nome', 'like', '%' . $busca . '%');
        }

        $cursos = $query->paginate($porPagina)->withQueryString();

        return view('relatorios.listagem-alunos', compact('cursos', 'porPagina', 'busca'));
    }
}

