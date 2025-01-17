<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [UsuariosController::class, 'index'])->name('login');

Route::name('usuarios.')->group(function () {
    Route::get('/', [UsuariosController::class, 'index'])->name('login');
    Route::post('/', [UsuariosController::class, 'login'])->name('login');
    Route::get('/create', [UsuariosController::class, 'create'])->name('create');
    Route::post('/usuarios', [UsuariosController::class, 'store'])->name('store');
    Route::get('/logout', [UsuariosController::class, 'logout'])->name('logout');
});

Route::prefix('clientes')->name('clientes.')->middleware('auth')->group(function () {
    Route::get('/', [ClienteController::class, 'index'])->name('index');
    Route::get('/create', [ClienteController::class, 'create'])->name('create');
    Route::post('/', [ClienteController::class, 'store'])->name('store');
    Route::get('/{cliente}', [ClienteController::class, 'show'])->name('show');
    Route::get('/{cliente}/edit', [ClienteController::class, 'edit'])->name('edit');
    Route::put('/{cliente}', [ClienteController::class, 'update'])->name('update');
    Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('destroy');
    Route::post('/{cliente}', [ClienteController::class, 'inativar'])->name('inativar');
});
