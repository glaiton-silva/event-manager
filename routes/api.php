<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiEventController;

// Rotas de API sem autenticação para teste
Route::get('events', [ApiEventController::class, 'index']);
Route::post('events', [ApiEventController::class, 'store']);
Route::get('events/{event}', [ApiEventController::class, 'show']);
Route::put('events/{event}', [ApiEventController::class, 'update']);
Route::delete('events/{event}', [ApiEventController::class, 'destroy']);
