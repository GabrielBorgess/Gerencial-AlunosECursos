<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CursoApiController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $cursos = Curso::all();
            return response()->json([
                'status' => 'success',
                'data' => $cursos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao buscar cursos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'codigo' => 'required|unique:cursos|string|max:255',
                'nome' => 'required|string|max:255',
            ]);

            $curso = Curso::create($validated);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Curso criado com sucesso',
                'data' => $curso
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao criar curso',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $curso = Curso::findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $curso
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Curso não encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao buscar curso',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $curso = Curso::findOrFail($id);
            
            $validated = $request->validate([
                'codigo' => 'required|string|max:255|unique:cursos,codigo,' . $curso->id,
                'nome' => 'required|string|max:255',
            ]);

            $curso->update($validated);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Curso atualizado com sucesso',
                'data' => $curso
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Curso não encontrado'
            ], 404);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro de validação',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao atualizar curso',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $curso = Curso::findOrFail($id);
            $curso->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Curso excluído com sucesso'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Curso não encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao excluir curso',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
