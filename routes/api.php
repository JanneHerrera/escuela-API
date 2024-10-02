<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\MateriaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource("estudiante", StudentController::class);

Route::apiResource("docente", TeacherController::class);

Route::apiResource("materia", MateriaController::class);
