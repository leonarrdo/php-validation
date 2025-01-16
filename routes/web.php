<?php

use App\Http\Controllers\ClienteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('clientes')->name('clientes.')->group(function () {
    Route::get('/', [ClienteController::class, 'index'])->name('index');
    Route::get('/create', [ClienteController::class, 'create'])->name('create');
    Route::post('/', [ClienteController::class, 'store'])->name('store');
    Route::get('/{cliente}', [ClienteController::class, 'show'])->name('show');
    Route::get('/{cliente}/edit', [ClienteController::class, 'edit'])->name('edit');
    Route::put('/{cliente}', [ClienteController::class, 'update'])->name('update');
    Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('destroy');
});
