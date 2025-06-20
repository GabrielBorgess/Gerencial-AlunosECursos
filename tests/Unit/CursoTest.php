<?php

namespace Tests\Unit;

use App\Models\Curso;
use App\Models\Aluno;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CursoTest extends TestCase
{
    use RefreshDatabase;

    public function test_curso_tem_muitos_alunos()
    {
        $curso = Curso::factory()->create();
        $aluno = Aluno::factory()->create(['curso_id' => $curso->id]);

        $this->assertTrue($curso->alunos->contains($aluno));
    }
}
