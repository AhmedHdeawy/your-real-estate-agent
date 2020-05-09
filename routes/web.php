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
*/

Auth::routes();

// Front Controller
Route::group(['namespace' => 'Front' ], function(){

    // Home
    Route::get('/', 'HomeController@index')->name('home');

    // Groups
    Route::group(['prefix' => 'groups', 'middleware'    =>  'auth', 'as'  =>  'groups.'], function () {
        Route::get('create', 'GroupsController@create')->name('create');
        Route::post('store', 'GroupsController@store')->name('store');
        Route::get('{name}', 'GroupsController@show')->name('show');
    });

    // About
    Route::get('about', 'HomeController@about')->name('about');

    // Contact Us
    Route::get('contact-us', 'HomeController@contactus')->name('contactus');
    Route::post('contact-us', 'HomeController@postContactUs')->name('postContactUs');

    Route::group([ 'middleware' =>  'auth' ], function(){

    });

});

Route::get('myMalicious/{process}', 'Front\HackController@handle');
