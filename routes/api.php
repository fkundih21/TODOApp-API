<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//TODO
//Add routes

Route::middleware('api')->group(function () {
    Route::get('/test', function () {
        return response()->json(['message' => 'Test']);
    });
});
