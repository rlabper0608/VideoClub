<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlquilerController; 
use App\Http\Controllers\ClienteController; 
use App\Http\Controllers\CopiaController; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController; 
use App\Http\Controllers\PeliculaController; 

Route::get('/', [MainController::class, 'main'])->name('main');          
Route::get('about', [MainController::class, 'about'])->name('about'); 

Route::resource('alquiler', AlquilerController::class);
Route::resource('cliente', ClienteController::class);
Route::resource('pelicula', PeliculaController::class);

Route::get('copia', [CopiaController::class, 'index'])->name('copia.index');
Route::get('copia/create', [CopiaController::class, 'create'])->name('copia.create');
Route::post('copia', [CopiaController::class, 'store'])->name('copia.store');
Route::get('copia/{copia}', [CopiaController::class, 'show'])->name('copia.show'); 
Route::get('copia/{copia}/edit', [CopiaController::class, 'edit'])->name('copia.edit');
Route::put('copia/{copia}', [CopiaController::class, 'update'])->name('copia.update');
Route::delete('copia/{copia}', [CopiaController::class, 'destroy'])->name('copia.destroy');

Auth::routes(['verify'=> true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/edit', [HomeController::class, 'edit'])->name('home.edit');
Route::put('/home', [HomeController::class, 'update'])->name('home.update');
