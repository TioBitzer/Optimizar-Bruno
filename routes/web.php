<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
Route::get('/optimizador',[OptimizadorController::class, 'index']);
Route::get('/optimizador',[OptimizadorController::class,'obtener']);
});
