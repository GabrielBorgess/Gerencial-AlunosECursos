<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('matricula')->unique();
            $table->string('nome');
            $table->foreignId('curso_id')->constrained()->onDelete('cascade');
            $table->string('cep');
            $table->string('endereco');
            $table->timestamps();
        });
    }
};
