<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth');


Route::controller(PostController::class)
    ->prefix('posts')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('/', 'getPosts');
        Route::post('/', 'createPost');
    });
