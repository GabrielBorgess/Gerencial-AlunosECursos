<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlunoFactory extends Factory
{
    public function definition()
    {
        return [
            'matricula' => $this->faker->unique()->numerify('MAT#####'),
            'nome' => $this->faker->name,
            'curso_id' => Curso::factory(), // Cria um curso automaticamente se não passar um
            'cep' => $this->faker->postcode,
            'endereco' => $this->faker->address,
        ];
    }
}
