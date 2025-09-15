<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TemplateController as AdminTemplateController;

// Frontend público
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutas públicas de templates
Route::get('/plantillas', [TemplateController::class, 'index'])->name('templates.index');
Route::get('/plantillas/{template:slug}', [TemplateController::class, 'show'])->name('templates.show');
Route::get('/categoria/{category:slug}', [TemplateController::class, 'category'])->name('templates.category');

// Admin (mantener como está)
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('templates', AdminTemplateController::class);
    });

