<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/user/store',[UserController::class,'store']);

Route::get('/user/index',[UserController::class,'index']);

Route::post('/user/delete/{id}',[UserController::class,'delete']);

Route::post('/user/update/{id}',[UserController::class,'update']);

Route::post('/post/store',[PostController::class,'store']);

Route::get('/post/index',[PostController::class,'index']);

Route::post('/post/delete/{id}',[PostController::class,'delete']);

Route::post('/post/update/{id}',[PostController::class,'update']);