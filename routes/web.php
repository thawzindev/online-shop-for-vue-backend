<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

/**
 * CMS route.
 */
Route::prefix(config('app.admin_prefix'))->group(function () // sample 'admin'
{
	Auth::routes(['register' => false]);
	Route::middleware(['auth', 'superadmin'])->group(function () {
		Route::get('/', 'Admin\DashboardController@index')->name('admin.index');
		Route::resource('users', 'Admin\UserController', ['as' => 'admin']);

	});
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
