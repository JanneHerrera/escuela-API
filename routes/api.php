<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource("estudiante", StudentController::class);

Route::apiResource("docente", TeacherController::class);
