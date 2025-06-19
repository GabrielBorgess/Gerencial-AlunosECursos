<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    private const DEFAULT_PER_PAGE = 5;

    public function index(Request $request)
    {
        $query = Aluno::with('curso');

        if ($request->filled('matricula')) {
            $query->where('matricula', 'like', "%{$request->matricula}%");
        }

        if ($request->filled('nome')) {
            $query->where('nome', 'like', "%{$request->nome}%");
        }

        if ($request->filled('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        $porPagina = $request->input('por_pagina', self::DEFAULT_PER_PAGE);

        $alunos = $query->paginate($porPagina)->appends($request->query());

        $cursos = Curso::all();

        return view('alunos.index', compact('alunos', 'cursos'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('alunos.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula' => 'required|unique:alunos',
            'nome' => 'required',
            'curso_id' => 'required|exists:cursos,id',
            'cep' => 'required',
            'endereco' => 'required',
        ]);

        Aluno::create($request->all());

        return redirect()->route('alunos.index')->with('success', 'Aluno cadastrado com sucesso.');
    }

    public function edit(Aluno $aluno)
    {
        $cursos = Curso::all();
        return view('alunos.edit', compact('aluno', 'cursos'));
    }

    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'matricula' => 'required|unique:alunos,matricula,' . $aluno->id,
            'nome' => 'required',
            'curso_id' => 'required|exists:cursos,id',
            'cep' => 'required',
            'endereco' => 'required',
        ]);

        $aluno->update($request->all());

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso.');
    }

    public function destroy(Aluno $aluno)
    {
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso.');
    }
}

