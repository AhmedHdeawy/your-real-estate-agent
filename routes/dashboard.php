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

            // Types Routes
            Route::resource('types', 'TypesController');

            // Periods Routes
            Route::resource('periods', 'PeriodsController');

            // Furnishings Routes
            Route::resource('furnishings', 'FurnishingsController');

            // Amenities Routes
            Route::resource('amenities', 'AmenitiesController');

            // Status Routes
            Route::resource('completings', 'CompletingsController');

            // Properties Routes
            Route::resource('properties', 'PropertiesController');

            // Categories Routes
            Route::resource('categories', 'CategoriesController');

            // Countries Routes
            Route::resource('countries', 'CountriesController');

            // States Routes
            Route::resource('states', 'StatesController');

            // Blogs Routes
            Route::resource('blogs', 'BlogsController');

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
