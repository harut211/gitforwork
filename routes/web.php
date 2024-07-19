<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(\App\Http\Middleware\SetLocaleMiddlwaer::class)->group(function () {
    Route::get('/locale', function () {
        return back();
    }) ->name('set-local');
});
