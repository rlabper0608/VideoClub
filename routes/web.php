<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController; 
use App\Http\Controllers\PeliculaController; 
use App\Http\Controllers\ClienteController; 
use App\Http\Controllers\CopiaController; 
use App\Http\Controllers\AlquilerController; 

Route::get('/', [MainController::class, 'main'])->name('main');          
Route::get('about', [MainController::class, 'about'])->name('about'); 

Route::resource('pelicula', PeliculaController::class);
Route::resource('cliente', ClienteController::class);
Route::resource('copia', CopiaController::class);
Route::resource('alquiler', AlquilerController::class);