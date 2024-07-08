<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('events', EventController::class);
});

// Rota de visualização do evento acessível sem autenticação
Route::get('datalhe-evento/{event}', [EventController::class, 'public_show'])->name('events.public_show');
