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
    Route::post('/search', 'HomeController@search')->name('search');

    Route::group(['middleware'    =>  'auth'], function () {

        Route::get('property/create', 'PropertiesController@create')->name('property.create');
        Route::post('property/store', 'PropertiesController@store')->name('property.store');
        Route::get('property/{property}/upload-images', 'PropertiesController@openUploadImages')->name('property.upload_images');
        Route::post('property/upload-images', 'PropertiesController@uploadImages')->name('property.store.upload_images');

        // User Profile
        Route::get('profile/{username}', 'UsersController@profile')->name('profile');
        // Route::get('profile', 'UsersController@profile')->name('profile');
        Route::post('profile', 'UsersController@updateProfile')->name('updateProfile');
    });

    // About
    Route::get('about', 'HomeController@about')->name('about');

    // Contact Us
    Route::get('contact-us', 'HomeController@contactus')->name('contactus');
    Route::post('contact-us', 'HomeController@postContactUs')->name('postContactUs');

});

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();
