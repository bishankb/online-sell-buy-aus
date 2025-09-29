<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

//Backend Routes
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

    Route::get('/contact-us/edit', 'App\Http\Controllers\Backend\ContactUsController@edit')->name('contact-us.edit');
    Route::patch('/contact-us/update', 'App\Http\Controllers\Backend\ContactUsController@update')->name('contact-us.update');

    Route::resource('/products', 'App\Http\Controllers\Backend\ProductController')->except('show', 'create');
    Route::get('/products/categories', 'App\Http\Controllers\Backend\ProductController@addCategories')->name('products.addCategories');
    Route::get('/products/get-sub-categories/{categoryId}', 'App\Http\Controllers\Backend\ProductController@getSubCategories')->name('products.getSubCategories');
    Route::post('/products/categories/add', 'App\Http\Controllers\Backend\ProductController@redirectProductForm')->name('products.redirectProductForm');
    Route::get('/products/{subCategorySlug}/create', 'App\Http\Controllers\Backend\ProductController@create')->name('products.create');
    Route::get('/products/{productSlug}/images', 'App\Http\Controllers\Backend\ProductController@addImages')->name('products.addImages');
    Route::post('/products/{productId}/images/add', 'App\Http\Controllers\Backend\ProductController@saveImages')->name('products.saveImages');
    Route::post('/products/{productId}/images/destory/{imageId}', 'App\Http\Controllers\Backend\ProductController@destoryImages')->name('products.destroyImages');
    Route::post('/products/change-status/{id}', 'App\Http\Controllers\Backend\ProductController@changeStatus')->name('products.changeStatus');
    Route::patch('/products/mark-sold/{id}', 'App\Http\Controllers\Backend\ProductController@markSold')->name('products.markSold');
    Route::patch('/products/mark-featured/{id}', 'App\Http\Controllers\Backend\ProductController@markFeatured')->name('products.markFeatured');
    Route::patch('/products/renew/{id}', 'App\Http\Controllers\Backend\ProductController@renew')->name('products.renew');
    Route::post('/products/restore/{id}', 'App\Http\Controllers\Backend\ProductController@restore')->name('products.restore');
    Route::delete('/products/force-delete/{id}', 'App\Http\Controllers\Backend\ProductController@forceDestroy')->name('products.forceDestroy');

    Route::get('/', 'App\Http\Controllers\Backend\DashboardController@index')->name('backend.dashboard');

});

//Frontend Routes
Route::get('/', 'App\Http\Controllers\Frontend\HomeController@index')->name('frontend.home');
Route::get('/faq', 'App\Http\Controllers\Frontend\FaqController@index')->name('frontend.faq');
Route::get('/term-condition', 'App\Http\Controllers\Frontend\TermConditionController@index')->name('frontend.term-condition');
Route::get('/privacy-policy', 'App\Http\Controllers\Frontend\PrivacyPolicyController@index')->name('frontend.privacy-policy');
Route::get('/rules-tips', 'App\Http\Controllers\Frontend\RuleTipController@index')->name('frontend.rule-tip');