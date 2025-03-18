<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware('api')->group(function () {
    //GET ALL TASKS
    Route::get('/tasks', [TaskController::class, 'index']);
    //GET ALL TASKS BY SPECIFIC USER
    Route::get('/users/{user_id}/tasks', [TaskController::class, 'getTasksByUser']);
    //GET TASK BY ID
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    //POST NEW TASK
    Route::post('/tasks', [TaskController::class, 'store']);
    //PUT UPDATE TASK
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    //DELETE TASK BY ID
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});
