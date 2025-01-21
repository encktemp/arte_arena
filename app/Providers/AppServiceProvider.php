<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra quaisquer serviços da aplicação.
     */
    public function register(): void
    {
        //
    }

    /**
     * Inicializa quaisquer serviços da aplicação.
     */
    public function boot(): void
    {
        // Define comprimento padrão para colunas do tipo string no banco de dados.
        Schema::defaultStringLength(191);
    }
}
