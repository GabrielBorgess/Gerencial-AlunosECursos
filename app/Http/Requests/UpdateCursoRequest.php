<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo' => 'required|string|max:10|unique:cursos,codigo,' . $this->curso->id,
            'nome' => 'required|string|max:100',
        ];
    }
}

