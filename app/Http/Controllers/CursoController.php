<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;

class CursoController extends Controller
{
    private const DEFAULT_PER_PAGE = 5;

    public function index(Request $request)
    {
        $query = Curso::query();

        if ($request->filled('codigo')) {
            $query->where('codigo', 'like', "%{$request->codigo}%");
        }

        if ($request->filled('nome')) {
            $query->where('nome', 'like', "%{$request->nome}%");
        }

        $porPagina = $request->input('por_pagina', self::DEFAULT_PER_PAGE);
        $porPagina = in_array($porPagina, [5, 10, 20, 50]) ? $porPagina : self::DEFAULT_PER_PAGE;

        $cursos = $query->orderBy('nome')
            ->paginate($porPagina)
            ->withQueryString();

        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(StoreCursoRequest $request)
    {
        Curso::create($request->validated());
        return redirect()->route('cursos.index')->with('success', 'Curso criado com sucesso!');
    }

    public function edit(Curso $curso)
    {
        return view('cursos.edit', compact('curso'));
    }

    public function update(UpdateCursoRequest $request, Curso $curso)
    {
        $curso->update($request->validated());
        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('cursos.index')->with('success', 'Curso excluído com sucesso!');
    }
}

