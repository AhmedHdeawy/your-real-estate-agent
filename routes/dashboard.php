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

// Dashboard Routes
Route::prefix('admin')
->name('admin.')
->group(function() {

	// Admin Login Routes
	Route::get('login', 'Auth\AdminLoginController@showLogin')->name('getLogin');
    Route::post('login', 'Auth\AdminLoginController@login')->name('postLogin');


	Route::group(['middleware'    =>  'admin'],function(){
	// Route::middleware(['admin', 'check_permission'])->group(function(){

        Route::group(['namespace' => 'Dashboard', 'middleware'  =>  ['check_permission']], function () {

            // Dashboard Routes
            Route::get('/', 'DashboardController@index')->name('dashboard.index');

            // Groups Routes
            Route::resource('groups', 'GroupsController')->except('create', 'store', 'edit');

            // Posts Routes
            Route::resource('posts', 'PostsController')->except('create', 'store', 'edit');

            // Countries Routes
            Route::resource('countries', 'CountriesController');

            // States Routes
            Route::resource('states', 'StatesController');

            // Infos Routes
            Route::resource('infos', 'InfosController')->except('create', 'store', 'destroy');

            // Settings Routes
            Route::resource('settings', 'SettingsController')->except('create', 'store', 'destroy');

            // ContactUs Routes
            Route::resource('contactus', 'ContactUsController');

            // Users Routes
            Route::resource('users', 'UsersController');

            // Admins Routes
            Route::resource('admins', 'AdminsController');

            // Roles Routes
            Route::resource('roles', 'RolesController');
            Route::get('permissions', 'RolesController@permissions')->name('roles.permissions');


        });

        // Admin Logout Route
        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');

	});


});
