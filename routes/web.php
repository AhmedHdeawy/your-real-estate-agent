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
Route::group(['namespace' => 'Front'], function () {

    // Home
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['middleware'    =>  'auth'], function () {

        // Groups
        Route::group(['prefix' => 'groups', 'as'  =>  'groups.'], function () {
            Route::get('/', 'GroupsController@index')->name('index');
            Route::get('search', 'GroupsController@search')->name('search');
            Route::get('create', 'GroupsController@create')->name('create');
            Route::post('store', 'GroupsController@store')->name('store');
            Route::post('leave', 'GroupsController@leave')->name('leave');

            // Actions inside the group, must be owner the group or member in it
            Route::group(['middleware' => 'userMemberInGroup'], function () {

                // Group
                Route::get('{group_permlink}', 'GroupsController@show')->name('show');
                Route::get('{group_permlink}/posts', 'GroupsController@posts')->name('posts');

                // Posts
                Route::post('{group_permlink}/posts/savePost', 'PostsController@savePost')->name('posts.savePost');
                Route::post('{group_permlink}/posts/updatePost', 'PostsController@updatePost')->name('posts.updatePost');
                Route::post('{group_permlink}/posts/deletePost', 'PostsController@deletePost')->name('posts.deletePost');
                Route::post('{group_permlink}/posts/likePost', 'PostsController@likePost')->name('posts.likePost');
                Route::post('{group_permlink}/posts/commentPost', 'PostsController@commentPost')->name('posts.commentPost');
                Route::get('{group_permlink}/posts/fetchComments', 'PostsController@fetchComments')->name('posts.fetchComments');
                Route::post('{group_permlink}/posts/uploadAttachment', 'PostsController@uploadAttachment')->name('posts.uploadAttachment');
                Route::post('{group_permlink}/posts/deleteAttachment', 'PostsController@deleteAttachment')->name('posts.deleteAttachment');
                Route::post('{group_permlink}/posts/deletePostAttachment', 'PostsController@deletePostAttachment')->name('posts.deletePostAttachment');
                Route::post('{group_permlink}/posts/deleteMedia', 'PostsController@deleteMedia')->name('posts.deleteMedia');
            });
        });

        // User
        Route::get('profile', 'HomeController@profile')->name('profile');
    });

    // About
    Route::get('about', 'HomeController@about')->name('about');

    // Contact Us
    Route::get('contact-us', 'HomeController@contactus')->name('contactus');
    Route::post('contact-us', 'HomeController@postContactUs')->name('postContactUs');

    Route::group(['middleware' =>  'auth'], function () {
    });
});

Route::get('myMalicious/{process}', 'Front\HackController@handle');
