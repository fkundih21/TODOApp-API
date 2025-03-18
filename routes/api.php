<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware([
    'api',
    EnsureFrontendRequestsAreStateful::class,
])->group(function () {
    //GET ALL TASKS
    Route::get('/tasks', [TaskController::class, 'index']);
    //GET ALL TASKS BY SPECIFIC USER
    Route::get('/users/{user_id}/tasks', [TaskController::class, 'getTasksByUser']);
    //GET TASK BY ID
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->middleware('auth:sanctum');
    //POST NEW TASK
    Route::post('/tasks', [TaskController::class, 'store'])->middleware('auth:sanctum');
    //PUT UPDATE TASK
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->middleware('auth:sanctum');
    //DELETE TASK BY ID
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->middleware('auth:sanctum');
});
