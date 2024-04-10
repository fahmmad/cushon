<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/invest/{id?}', [App\Http\Controllers\InvestController::class, 'index'])->name('invest');
    Route::post('/invest', [App\Http\Controllers\InvestController::class, 'save'])->name('invest.save');
});
