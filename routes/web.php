<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Admin\CategoryController;

// Ruta principal - catálogo de plantillas
Route::get('/', [TemplateController::class, 'index'])->name('home');

// Admin - requiere autenticación + verificación de admin
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categories', CategoryController::class);
    });
