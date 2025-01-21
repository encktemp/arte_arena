<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::get('/', function () {
    return view('welcome'); // Ou outro conteúdo que desejar
});


// Adicione uma rota para verificar o ItemController
Route::get('/item-test', [ItemController::class, 'index']);

Route::get('/test-items', [ItemController::class, 'index']);

// routes/web.php
Route::get('/teste', function () {
    return 'Funcionando!';
});
