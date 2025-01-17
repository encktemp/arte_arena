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
        Schema::create('sync_logs', function (Blueprint $table) {
            $table->id(); // Identificador único (chave primária).
            $table->dateTime('processed_at'); // Data e hora do processamento.
            $table->integer('records_processed'); // Número de registros processados.
            $table->timestamps(); // Campos padrão do Laravel: created_at e updated_at.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sync_logs'); // Remove a tabela em caso de rollback.
    }
};
