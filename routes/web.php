<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth']
], function(){
    Route::resource('/users', 'App\Http\Controllers\Backend\UserController');
});