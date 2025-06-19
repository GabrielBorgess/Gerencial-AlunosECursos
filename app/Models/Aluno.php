<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula',
        'nome',
        'curso_id',
        'cep',
        'endereco',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }
}
