<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::resource('/users',UsersController::class);
Route::middleware('api')->group(function () {
  Route::get('/users', [UsersController::class, 'index']);
  Route::get('/users/create', [UsersController::class, 'create']);
  Route::post('/users', [UsersController::class, 'store']);
  Route::put('/users/{id}', [UsersController::class, 'update']);
  Route::delete('/users/{id}', [UsersController::class, 'destroy']);
});