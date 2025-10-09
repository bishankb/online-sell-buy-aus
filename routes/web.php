<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);
use App\Http\Controllers\Auth\GoogleController;

//Backend Routes
Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth']
], function(){
    Route::resource('/users', 'App\Http\Controllers\Backend\UserController');
    Route::patch('/users/edit-profile/{id}', 'App\Http\Controllers\Backend\UserController@editProfile')->name('users.editProfile');
    Route::patch('/users/change-password/{id}', 'App\Http\Controllers\Backend\UserController@changePassword')->name('users.changePassword');
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

    Route::resource('/buyer-questions', 'App\Http\Controllers\Backend\BuyerQuestionController');
    Route::get('/buyer-questions/{buyer_question}/reply', 'App\Http\Controllers\Backend\BuyerQuestionController@reply')->name('buyer-questions.reply');
    Route::patch('/buyer-questions/{buyer_question}/send-reply', 'App\Http\Controllers\Backend\BuyerQuestionController@sendReply')->name('buyer-questions.sendReply');

});

//Frontend Routes
Route::get('/', 'App\Http\Controllers\Frontend\HomeController@index')->name('frontend.home');

Route::get('/faq', 'App\Http\Controllers\Frontend\FaqController@index')->name('frontend.faq');

Route::get('/term-condition', 'App\Http\Controllers\Frontend\TermConditionController@index')->name('frontend.term-condition');
Route::get('/privacy-policy', 'App\Http\Controllers\Frontend\PrivacyPolicyController@index')->name('frontend.privacy-policy');
Route::get('/rules-tips', 'App\Http\Controllers\Frontend\RuleTipController@index')->name('frontend.rule-tip');

Route::get('/product/{productViewType}', 'App\Http\Controllers\Frontend\ProductController@index')->name('product.index');
Route::get('/view-product/{product}', 'App\Http\Controllers\Frontend\ProductController@show')->name('product.show');
Route::get('/filter/product', 'App\Http\Controllers\Frontend\ProductController@filter')->name('product.filter');
Route::get('/search/product', 'App\Http\Controllers\Frontend\ProductController@search')->name('product.search');

Route::get('/contact-us', 'App\Http\Controllers\Frontend\ContactUsController@index')->name('contact-us.index');
Route::post('/contact-us/send', 'App\Http\Controllers\Frontend\ContactUsController@send')->name('contact-us.send');

Route::group([
    'middleware' => ['auth', 'verified']
], function(){    
    Route::get('/buyer-question/{productSlug}/read-more', 'App\Http\Controllers\Frontend\BuyerQuestionController@readMore')->name('buyer-question.readMore');
    Route::post('/buyer-question/store', 'App\Http\Controllers\Frontend\BuyerQuestionController@store')->name('buyer-question.store');

    Route::get('/product-section/categories', 'App\Http\Controllers\Frontend\ProductSectionController@addCategories')->name('product-section.addCategories');
    Route::get('/product-section/get-sub-categories/{categoryId}', 'App\Http\Controllers\Frontend\ProductSectionController@getSubCategories')->name('product-section.getSubCategories');
    Route::post('/product-section/categories/add', 'App\Http\Controllers\Frontend\ProductSectionController@redirectProductForm')->name('product-section.redirectProductForm');
    Route::get('/product-section/{subCategorySlug}/create', 'App\Http\Controllers\Frontend\ProductSectionController@create')->name('product-section.create');
    Route::post('/product-section/store', 'App\Http\Controllers\Frontend\ProductSectionController@store')->name('product-section.store');
    Route::get('/product-section/{productSlug}/images', 'App\Http\Controllers\Frontend\ProductSectionController@addImages')->name('product-section.addImages');
    Route::post('/product-section/{productId}/images/add', 'App\Http\Controllers\Frontend\ProductSectionController@saveImages')->name('product-section.saveImages');
    Route::post('/product-section/{productId}/images/destory/{imageId}', 'App\Http\Controllers\Frontend\ProductSectionController@destoryImages')->name('product-section.destroyImages');

    Route::group([
        'prefix' => 'my-account/dashboard'
    ], function () {
        Route::get('/', 'App\Http\Controllers\Frontend\UserAccount\AccountController@index')->name('my-account.index');
        Route::get('/profile', 'App\Http\Controllers\Frontend\UserAccount\AccountController@showProfile')->name('my-account.showProfile');
        Route::patch('/profile/update', 'App\Http\Controllers\Frontend\UserAccount\AccountController@updateProfile')->name('my-account.updateProfile');
        Route::post('/profile/delete-image/{id}', 'App\Http\Controllers\Frontend\UserAccount\AccountController@destroyImage')->name('my-account.destroyImage');
        Route::get('/change-password', 'App\Http\Controllers\Frontend\UserAccount\AccountController@changePassword')->name('my-account.changePassword');
        Route::patch('/update-password', 'App\Http\Controllers\Frontend\UserAccount\AccountController@updatePassword')->name('my-account.updatePassword');
        
        Route::resource('/product-section', 'App\Http\Controllers\Frontend\UserAccount\ProductSectionController')->except('create', 'store', 'show');
        Route::patch('/product-section/mark-sold/{product}', 'App\Http\Controllers\Frontend\UserAccount\ProductSectionController@markSold')->name('product-section.markSold');
        Route::patch('/product-section/renew/{id}', 'App\Http\Controllers\Frontend\UserAccount\ProductSectionController@renew')->name('product-section.renew');

        Route::resource('/buyer-question', 'App\Http\Controllers\Frontend\UserAccount\BuyerQuestionController')->except('create', 'store', 'destroy');
        Route::get('/buyer-question/{buyer_question}/reply', 'App\Http\Controllers\Frontend\UserAccount\BuyerQuestionController@reply')->name('buyer-question.reply');
        Route::patch('/buyer-question/{buyer_question}/send-reply', 'App\Http\Controllers\Frontend\UserAccount\BuyerQuestionController@sendReply')->name('buyer-question.sendReply');

        Route::resource('/your-question', 'App\Http\Controllers\Frontend\UserAccount\YourQuestionController')->except('create', 'store', 'show', 'destroy');
        Route::get('/your-question/{buyer_question}/view-reply', 'App\Http\Controllers\Frontend\UserAccount\YourQuestionController@viewReply')->name('your-question.view-reply');

        Route::get('notification', 'App\Http\Controllers\Frontend\UserAccount\NotificationController@viewNotification')->name('notification.view-notification');
        Route::get('mark-read', 'App\Http\Controllers\Frontend\UserAccount\NotificationController@markRead')->name('notification.mark-read');
        Route::delete('notification/delete/{id}', 'App\Http\Controllers\Frontend\UserAccount\NotificationController@destroy')->name('notification.destroy');

        Route::get('notification/read/{id}', 'App\Http\Controllers\Frontend\UserAccount\NotificationController@read')->name('notification.read');

    });
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);





