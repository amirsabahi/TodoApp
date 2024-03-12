<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\TodoController;
use \App\Models\Todo;
use \App\Http\Resources\TodoResource;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/todos', function () {
        return new TodoResource(Todo::all());
    });
    Route::post('todo/toggle/{id}', [TodoController::class, 'toggleIsCompleted']);
    Route::post('todo', [TodoController::class, 'create']);
});

