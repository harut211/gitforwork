<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WebController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('post')->group(function () {
    Route::post('/create',  [PostController::class, 'create'])->name('post.create');
});

Route::prefix('/webs')->group(function (){
   Route::post('/subscribe',[WebController::class,'subscribe'])->name('webs.subscribe');
});
