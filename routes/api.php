<?php

use Illuminate\Http\Request;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::middleware('api')->group(function () {
    //GET ALL TASKS
    Route::get('/tasks', [TaskController::class, 'index']);
});
