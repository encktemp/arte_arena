<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define o schedule dos comandos.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Agenda o Job SyncPostsJob para executar a cada minuto (ideal para testes)
        $schedule->job(new \App\Jobs\SyncPostsJob)->everyMinute();
    }

    /**
     * Registra os comandos da aplicação.
     */
    protected function commands(): void
    {
        // Carrega comandos customizados na pasta app/Console/Commands
        $this->load(__DIR__ . '/Commands');

        // Inclui as rotas de console definidas no arquivo routes/console.php
        require base_path('routes/console.php');
    }
}
