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
    Route::post('/users/edit-profile/{id}', 'App\Http\Controllers\Backend\UserController@editProfile')->name('users.editProfile');
    Route::post('/users/change-password/{id}', 'App\Http\Controllers\Backend\UserController@changePassword')->name('users.changePassword');
    Route::post('/users/change-status/{id}', 'App\Http\Controllers\Backend\UserController@changeStatus')->name('users.changeStatus');
    Route::post('/users/restore/{id}', 'App\Http\Controllers\Backend\UserController@restore')->name('users.restore');
    Route::delete('/users/force-delete/{id}', 'App\Http\Controllers\Backend\UserController@forceDestroy')->name('users.forceDestroy');
    Route::post('/users/delete-image/{id}', 'App\Http\Controllers\Backend\UserController@destroyImage')->name('users.destroyImage');

    Route::resource('/cities', 'App\Http\Controllers\Backend\CityController');
    Route::resource('/countries', 'App\Http\Controllers\Backend\CountryController');

    Route::resource('/categories', 'App\Http\Controllers\Backend\CategoryController');
    Route::post('/categories/change-status/{id}', 'App\Http\Controllers\Backend\CategoryController@changeStatus')->name('categories.changeStatus');
    Route::post('/categories/restore/{id}', 'App\Http\Controllers\Backend\CategoryController@restore')->name('categories.restore');
    Route::delete('/categories/force-delete/{id}', 'App\Http\Controllers\Backend\CategoryController@forceDestroy')->name('categories.forceDestroy');

    Route::resource('/sub-categories', 'App\Http\Controllers\Backend\SubCategoryController');
    Route::post('/sub-categories/change-home-visibility/{id}', 'App\Http\Controllers\Backend\SubCategoryController@changeHomeVisibility')->name('sub-categories.changeHomeVisibility');
    Route::post('/sub-categories/change-status/{id}', 'App\Http\Controllers\Backend\SubCategoryController@changeStatus')->name('sub-categories.changeStatus');
    Route::post('/sub-categories/restore/{id}', 'App\Http\Controllers\Backend\SubCategoryController@restore')->name('sub-categories.restore');
    Route::delete('/sub-categories/force-delete/{id}', 'App\Http\Controllers\Backend\SubCategoryController@forceDestroy')->name('sub-categories.forceDestroy');

    Route::resource('roles', 'App\Http\Controllers\Backend\RoleController');

    Route::resource('/faqs', 'App\Http\Controllers\Backend\FaqController');
    Route::post('/faqs/change-status/{id}', 'App\Http\Controllers\Backend\FaqController@changeStatus')->name('faqs.changeStatus');
    Route::post('/faqs/restore/{id}', 'App\Http\Controllers\Backend\FaqController@restore')->name('faqs.restore');
    Route::delete('/faqs/force-delete/{id}', 'App\Http\Controllers\Backend\FaqController@forceDestroy')->name('faqs.forceDestroy');


});