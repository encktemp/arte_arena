<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // Cria o campo 'id' como chave primária
            $table->string('title'); // Campo 'title' para armazenar títulos (string)
            $table->text('body'); // Campo 'body' para armazenar textos longos
            $table->timestamps(); // Campos 'created_at' e 'updated_at' gerados automaticamente
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items'); // Remove a tabela 'items' caso seja necessário reverter a migração
    }
};
