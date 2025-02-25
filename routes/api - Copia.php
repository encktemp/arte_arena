<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

Route::middleware('api')->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('/items', [ItemController::class, 'index']);
        Route::get('/items/{id}', [ItemController::class, 'show']);
        Route::post('/items', [ItemController::class, 'store']);
        Route::put('/items/{id}', [ItemController::class, 'update']);
        Route::delete('/items/{id}', [ItemController::class, 'destroy']);
    });

    // Rota de teste
    Route::get('/test-api', function () {
        return response()->json(['message' => 'API funcionando!']);
    });
});