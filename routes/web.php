<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/rutas', function () {
    return view('rutas');
})->name('rutas');

Route::get('/contacto', function () {
    return view('contacto'); // Página de contacto
})->name('contacto');

Route::get('/registrarse', function () {
    return view('registrarse');
})->name('registrarse');

Route::get('/iniciarsesion', function () {
    return view('iniciarsesion');
})->name('iniciarsesion');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';