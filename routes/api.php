<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;



Route::middleware([
    'api',
    EnsureFrontendRequestsAreStateful::class,
])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

    Route::middleware('auth:sanctum')->group(function () {
        //GET ALL TASKS
        Route::get('/tasks', [TaskController::class, 'index']);
        //GET ALL TASKS BY SPECIFIC USER
        Route::get('/users/{user_id}/tasks', [TaskController::class, 'getTasksByUser']);
        //GET TASK BY ID
        Route::get('/tasks/{task}', [TaskController::class, 'show']);
        //POST NEW TASK
        Route::post('/tasks', [TaskController::class, 'store']);
        //PUT UPDATE TASK
        Route::put('/tasks/{task}', [TaskController::class, 'update']);
        //DELETE TASK BY ID
        Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    });
});
