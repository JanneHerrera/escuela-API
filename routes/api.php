<?php

use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/estudiantes', [Estudiante::class, 'index']);

Route::get('/estudiantes/{id}', [Estudiante::class, 'index']);

Route::post('/estudiantes', [Estudiante::class, 'index']);

Route::patch('/estudiantes/{id}', [Estudiante::class, 'index']);

Route::put('/estudiantes/{id}', [Estudiante::class, 'index']);

Route::delete('/estudiantes/{id}', [Estudiante::class, 'index']);
