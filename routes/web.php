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

        // Actions inside the group, must be owner the group or member in it
        Route::group(['middleware' => 'userMemberInGroup'], function () {

            Route::get('{name}', 'GroupsController@show')->name('show');
            Route::get('{name}/posts', 'GroupsController@posts')->name('posts');
            Route::post('{name}/posts/uploadAttachment', 'PostsController@uploadAttachment')->name('posts.uploadAttachment');
            Route::post('{name}/posts/deleteAttachment', 'PostsController@deleteAttachment')->name('posts.deleteAttachment');
        });
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
