<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelatorioFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_autenticado_ve_relatorio_de_alunos_por_curso()
    {
        $user = User::factory()->create();
        $curso = Curso::factory()->create(['nome' => 'Curso Teste']);
        Aluno::factory()->count(3)->create(['curso_id' => $curso->id]);

        $response = $this->actingAs($user)->get('/relatorios/alunos-por-curso');

        $response->assertStatus(200);
        $response->assertSee('Curso Teste');
        $response->assertSee('3');
    }
}
