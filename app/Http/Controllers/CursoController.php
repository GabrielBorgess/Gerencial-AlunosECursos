<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCursoRequest;
use App\Http\Requests\UpdateCursoRequest;

class CursoController extends Controller
{
    public function index(Request $request)
    {
        $query = Curso::query();

        if ($request->filled('codigo')) {
            $query->where('codigo', 'like', "%{$request->codigo}%");
        }

        if ($request->filled('nome')) {
            $query->where('nome', 'like', "%{$request->nome}%");
        }

        $cursos = $query->orderBy('nome')->paginate(5)->withQueryString();

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

