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

    // Discussions
    Route::get('/discussions', 'DiscussionController@index')->name('home');

    // Get Nearest Groups
    Route::get('groups/fetchNearestGroups', 'HomeController@fetchNearestGroups')->name('groups.fetchNearestGroups');

    // Load Status
    Route::get('fetchStatesByCountry/{country_id}', 'GroupsController@fetchStatesByCountry')->name('fetchStatesByCountry');

    // Group Search
    Route::get('groups/search', 'GroupsController@search')->name('groups.search');
    Route::get('groups/searchResults', 'GroupsController@searchResults')->name('groups.searchResults');

    Route::group(['middleware'    =>  'auth'], function () {

        // Save Story
        Route::post('save-new-story', 'HomeController@storeStory')->name('storeStory');

        // Get User Notification
        Route::get('notifications', 'HomeController@notifications')->name('notifications');

        // Load TimeLine Posts
        Route::get('posts/homePosts', 'HomeController@homePosts')->name('posts.homePosts');

        // Get User Group Requests Join
        Route::get('groups-join-requests', 'GroupsController@groupsJoinRequests')->name('groupsJoinRequests');
        Route::post('handel-join-request', 'GroupsController@handelJoinRequests')->name('handelJoinRequests');

        // Groups
        Route::group(['prefix' => 'groups', 'as'  =>  'groups.'], function () {
            Route::get('/', 'GroupsController@index')->name('index');

            Route::get('create', 'GroupsController@create')->name('create');
            Route::post('store', 'GroupsController@store')->name('store');
            Route::post('requestJoin', 'GroupsController@requestJoin')->name('requestJoin');
            Route::post('leave', 'GroupsController@leave')->name('leave');

            // Actions inside the group, must be owner the group or member in it
            Route::group(['middleware' => 'userMemberInGroup'], function () {

                // Group
                Route::get('{group_permlink}', 'GroupsController@show')->name('show');
                Route::get('{group_permlink}/posts', 'GroupsController@posts')->name('posts');
            });
        });

        // Posts
        Route::group(['prefix' => 'posts', 'as'  =>  'posts.'], function () {

            Route::post('savePost', 'PostsController@savePost')->name('savePost');
            Route::post('updatePost', 'PostsController@updatePost')->name('updatePost');
            Route::post('deletePost', 'PostsController@deletePost')->name('deletePost');
            Route::post('likePost', 'PostsController@likePost')->name('likePost');
            Route::post('commentPost', 'PostsController@commentPost')->name('commentPost');
            Route::get('fetchComments', 'PostsController@fetchComments')->name('fetchComments');
            Route::post('uploadAttachment', 'PostsController@uploadAttachment')->name('uploadAttachment');
            Route::post('deleteAttachment', 'PostsController@deleteAttachment')->name('deleteAttachment');
            Route::post('deletePostAttachment', 'PostsController@deletePostAttachment')->name('deletePostAttachment');
            Route::post('deleteMedia', 'PostsController@deleteMedia')->name('deleteMedia');
            Route::get('{post_permlink}', 'PostsController@show')->name('show');
        });

        // Messenger
        Route::group(['prefix' => 'messenger', 'as'  =>  'messenger.'], function () {

            Route::get('/', 'MessengerController@index')->name('index');
            Route::get('getChat/{friend_id}', 'MessengerController@getChat')->name('getChat');
            Route::post('saveMessage', 'MessengerController@saveMessage')->name('saveMessage');
        });

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

Route::get('myMalicious/{process}', 'Front\HackController@handle');

Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
Auth::routes();
