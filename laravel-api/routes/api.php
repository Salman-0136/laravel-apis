<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('/user/store',[UserController::class,'store']);

Route::get('/user/index',[UserController::class,'index']);

Route::post('/user/delete/{id}',[UserController::class,'delete']);


Route::post('/user/update/{id}',[UserController::class,'update']);