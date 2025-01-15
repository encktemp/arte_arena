<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

// Rota principal (opcional)
Route::get('/', function () {
    return view('welcome');
});

// Rotas CRUD para o recurso 'items'
Route::get('/items', [ItemController::class, 'index']); // Listar todos os itens
Route::post('/items', [ItemController::class, 'store']); // Criar um novo item
Route::get('/items/{id}', [ItemController::class, 'show']); // Exibir um item específico
Route::put('/items/{id}', [ItemController::class, 'update']); // Atualizar um item
Route::delete('/items/{id}', [ItemController::class, 'destroy']); // Remover um item
