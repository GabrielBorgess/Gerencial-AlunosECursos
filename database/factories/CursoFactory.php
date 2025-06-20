<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CursoFactory extends Factory
{
    public function definition()
    {
        return [
            'codigo' => $this->faker->unique()->bothify('CUR###'),
            'nome' => $this->faker->words(3, true),
        ];
    }
}
