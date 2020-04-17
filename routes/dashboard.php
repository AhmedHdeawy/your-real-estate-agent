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


	Route::middleware(['admin', 'check_permission'])->group(function(){

		// Dashboard Routes
		Route::get('/', 'Dashboard\DashboardController@index')->name('dashboard.index');


       	// Infos Routes
    	Route::resource('infos', 'Dashboard\InfosController')->except('create', 'store', 'destroy');

    	// Settings Routes
    	Route::resource('settings', 'Dashboard\SettingsController')->except('create', 'store', 'destroy');

        // ContactUs Routes
        Route::resource('contactus', 'Dashboard\ContactUsController');

    	// Users Routes
    	Route::resource('users', 'Dashboard\UsersController');

        // Admins Routes
        Route::resource('admins', 'Dashboard\AdminsController');

        // Roles Routes
        Route::resource('roles', 'Dashboard\RolesController');
        Route::get('permissions', 'Dashboard\RolesController@permissions')->name('roles.permissions');


        // Admin Logout Route
        Route::post('logout', 'Auth\AdminLoginController@logout')->name('logout');


	});


});
