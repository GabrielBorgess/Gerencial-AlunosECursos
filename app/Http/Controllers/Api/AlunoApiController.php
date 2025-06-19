<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AlunoApiController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $alunos = Aluno::with('curso')->get();
            return response()->json([
                'status' => 'success',
                'data' => $alunos
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao buscar alunos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'matricula' => 'required|unique:alunos|string|max:255',
                'nome' => 'required|string|max:255',
                'curso_id' => 'required|exists:cursos,id',
                'cep' => 'required|string|size:8',
                'endereco' => 'required|string|max:255',
            ]);

            $aluno = Aluno::create($validated);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Aluno criado com sucesso',
                'data' => $aluno->load('curso')
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
                'message' => 'Erro ao criar aluno',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $aluno = Aluno::with('curso')->findOrFail($id);
            
            return response()->json([
                'status' => 'success',
                'data' => $aluno
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aluno não encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao buscar aluno',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $aluno = Aluno::findOrFail($id);
            
            $validated = $request->validate([
                'matricula' => 'required|string|max:255|unique:alunos,matricula,' . $aluno->id,
                'nome' => 'required|string|max:255',
                'curso_id' => 'required|exists:cursos,id',
                'cep' => 'required|string|size:8',
                'endereco' => 'required|string|max:255',
            ]);

            $aluno->update($validated);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Aluno atualizado com sucesso',
                'data' => $aluno->load('curso')
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aluno não encontrado'
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
                'message' => 'Erro ao atualizar aluno',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $aluno = Aluno::findOrFail($id);
            $aluno->delete();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Aluno excluído com sucesso'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aluno não encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao excluir aluno',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
