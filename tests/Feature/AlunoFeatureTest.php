<?php

namespace Tests\Feature;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AlunoFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_pode_criar_aluno()
    {
        $user = User::factory()->create();
        $curso = Curso::factory()->create();

        $response = $this->actingAs($user)->post('/alunos', [
            'matricula' => 'MAT12345',
            'nome' => 'Aluno Teste',
            'curso_id' => $curso->id,
            'cep' => '12345-678',
            'endereco' => 'Rua Teste, 123',
        ]);

        $response->assertRedirect('/alunos');
        $this->assertDatabaseHas('alunos', [
            'matricula' => 'MAT12345',
            'nome' => 'Aluno Teste',
        ]);
    }

    public function test_validacao_nao_permite_criar_aluno_sem_nome()
    {
        $user = User::factory()->create();
        $curso = Curso::factory()->create();

        $response = $this->actingAs($user)->post('/alunos', [
            'matricula' => 'MAT12346',
            'nome' => '',
            'curso_id' => $curso->id,
            'cep' => '12345-678',
            'endereco' => 'Rua Teste, 123',
        ]);

        $response->assertSessionHasErrors('nome');
        $this->assertDatabaseMissing('alunos', [
            'matricula' => 'MAT12346',
        ]);
    }

    public function test_usuario_autenticado_pode_editar_aluno()
    {
        $user = User::factory()->create();
        $curso = Curso::factory()->create();
        $aluno = Aluno::factory()->create(['curso_id' => $curso->id, 'nome' => 'Antigo Nome']);

        $response = $this->actingAs($user)->put("/alunos/{$aluno->id}", [
            'matricula' => $aluno->matricula,
            'nome' => 'Novo Nome',
            'curso_id' => $curso->id,
            'cep' => $aluno->cep,
            'endereco' => $aluno->endereco,
        ]);

        $response->assertRedirect('/alunos');
        $this->assertDatabaseHas('alunos', [
            'id' => $aluno->id,
            'nome' => 'Novo Nome',
        ]);
    }

    public function test_usuario_autenticado_pode_excluir_aluno()
    {
        $user = User::factory()->create();
        $aluno = Aluno::factory()->create();
    
        $response = $this->actingAs($user)->delete("/alunos/{$aluno->id}");
    
        $response->assertRedirect('/alunos');
        $this->assertDatabaseMissing('alunos', [
            'id' => $aluno->id,
        ]);
    }
}
