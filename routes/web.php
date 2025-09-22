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
    Route::post('/users/{id}/edit-profile/', 'App\Http\Controllers\Backend\UserController@editProfile')->name('users.editProfile');
    Route::post('/users/{id}/change-password/', 'App\Http\Controllers\Backend\UserController@changePassword')->name('users.changePassword');
    Route::post('/users/{id}/change-status/', 'App\Http\Controllers\Backend\UserController@changeStatus')->name('users.changeStatus');
    Route::post('/users/{id}/restore/', 'App\Http\Controllers\Backend\UserController@restore')->name('users.restore');
    Route::delete('/users/{id}/force-delete/', 'App\Http\Controllers\Backend\UserController@forceDestroy')->name('users.forceDestroy');
    Route::post('/users/{id}/delete-image/', 'App\Http\Controllers\Backend\UserController@destroyImage')->name('users.destroyImage');

    Route::resource('/cities', 'App\Http\Controllers\Backend\CityController');
    Route::resource('/countries', 'App\Http\Controllers\Backend\CountryController');
});