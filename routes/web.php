<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('clients.index') : redirect()->route('login');
});

Auth::routes();

Route::get('/home', function () {
    return redirect()->route('clients.index');
})->name('home');

use App\Http\Controllers\ClientController;

Route::middleware(['auth'])->group(function () {
    Route::resource('clients', ClientController::class);
});
