<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@welcome');

Route::group(['prefix' => 'home', 'namespace' => 'Home'], function () {
	Route::get('/', 'HomeController@index')->name('home.index');

	Route::group(['prefix' => 'collections', 'namespace' => 'Collections'], function () {
		Route::get('sites/find', 'SiteFinderController@find');

		Route::post('/', 'CollectionController@store')->name('collections.store');
	});
});
