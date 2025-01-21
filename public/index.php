<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Verifica se a aplicação está em modo de manutenção
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
    exit; // Finaliza o script em modo de manutenção
}

// Carrega o autoloader do Composer
require __DIR__ . '/../vendor/autoload.php';

// Certifica-se de que o arquivo bootstrap está presente
$appFile = __DIR__ . '/../bootstrap/app.php';

if (!file_exists($appFile)) {
    http_response_code(500);
    echo "Erro: O arquivo 'bootstrap/app.php' está faltando. Verifique sua instalação do Laravel.";
    exit;
}

// Inicializa a aplicação Laravel
$app = require_once $appFile;

// Cria a instância do Kernel e processa a requisição
$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
