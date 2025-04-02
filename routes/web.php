<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\ClientController;

Route::middleware(['auth'])->group(function () {
    Route::resource('clients', ClientController::class);
});
