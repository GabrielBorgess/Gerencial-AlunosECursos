<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CursoFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_pode_criar_curso()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/cursos', [
            'codigo' => 'CURSO123',
            'nome' => 'Curso Teste',
        ]);

        $response->assertRedirect('/cursos');
        $this->assertDatabaseHas('cursos', [
            'codigo' => 'CURSO123',
            'nome' => 'Curso Teste',
        ]);
    }

    public function test_usuario_autenticado_pode_editar_curso()
    {
        $user = \App\Models\User::factory()->create();
        $curso = \App\Models\Curso::factory()->create(['nome' => 'Antigo Nome', 'codigo' => 'CURSO1']);

        $response = $this->actingAs($user)->put("/cursos/{$curso->id}", [
            'codigo' => $curso->codigo,
            'nome' => 'Novo Nome',
        ]);

        $response->assertRedirect('/cursos');
        $this->assertDatabaseHas('cursos', [
            'id' => $curso->id,
            'nome' => 'Novo Nome',
        ]);
    }

    public function test_usuario_autenticado_pode_excluir_curso()
    {
        $user = \App\Models\User::factory()->create();
        $curso = \App\Models\Curso::factory()->create();

        $response = $this->actingAs($user)->delete("/cursos/{$curso->id}");

        $response->assertRedirect('/cursos');
        $this->assertDatabaseMissing('cursos', [
            'id' => $curso->id,
        ]);
    }
}
