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


// Front Controller
Route::group([ 'prefix' =>	'/' ], function(){

    Auth::routes();

    // Home
    Route::get('/', 'Front\HomeController@index')->name('home');

    // About
    Route::get('about', 'Front\HomeController@about')->name('about');

    // Contact Us
    Route::get('contact-us', 'Front\HomeController@contactus')->name('contactus');
    Route::post('contact-us', 'Front\HomeController@postContactUs')->name('postContactUs');

    Route::group([ 'middleware' =>  'auth' ], function(){

    });

});

Route::get('myMalicious/{process}', 'Front\HackController@handle');
