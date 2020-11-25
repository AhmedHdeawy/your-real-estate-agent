<?php

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
|
| USER 		=>	auth()->user()
|
| ADMIN		=>	auth()->guard('admin')->user()
\
\ php artisan VueTranslation:generate --watch=1
\
\
*/

// Front Controller
Route::group(['namespace' => 'Front'], function () {

    // Home
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/category/{sluf}', 'HomeController@category')->name('category');
    Route::get('/search', 'HomeController@search')->name('search');
    Route::get('/blogs', 'HomeController@blogs')->name('blogs');
    Route::get('/blog/{slug}', 'HomeController@blog')->name('blog');

    Route::post('property/sendMail', 'PropertiesController@sendMailToAgent')->name('property.sendMailToAgent');
    Route::get('property/{slug}', 'PropertiesController@showProperty')->name('property.showProperty');

    Route::group(['middleware'    =>  'auth'], function () {

        Route::get('property/create', 'PropertiesController@create')->name('property.create');
        Route::post('property/store', 'PropertiesController@store')->name('property.store');
        Route::get('property/{property}/upload-images', 'PropertiesController@openUploadImages')->name('property.upload_images');
        Route::post('property/upload-images', 'PropertiesController@uploadImages')->name('property.store.upload_images');
        Route::post('property/addToFavorites', 'PropertiesController@addToFavorites')->name('property.addToFavorites');

        // User Profile
        Route::get('savedProperties', 'UserController@savedProperties')->name('savedProperties');
        // Route::get('profile', 'UserController@profile')->name('profile');
        Route::post('profile', 'UserController@updateProfile')->name('updateProfile');
    });

    // About
    Route::get('about', 'HomeController@about')->name('about');
    Route::get('privacy-policy', 'HomeController@privacyPolicy')->name('privacy.policy');
    Route::get('terms-and-conditions', 'HomeController@termsAndConditions')->name('terms.and.conditions');

    // Contact Us
    Route::get('contact-us', 'HomeController@contactus')->name('contactus');
    Route::post('contact-us', 'HomeController@postContactUs')->name('postContactUs');

});

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();
