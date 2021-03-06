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

	Route::get('/user', function () {
		return \App\User::with('interests')->get();
	});

	Route::get('/get-interests', function () {
		$interests = \App\Models\Category::orderBy('title', 'asc')->get();
		return response()->json(compact('interests'));
	});

	Route::post('/user/interest', 'UserController@storeInterests')->name('home.user.store-interests');

	Route::get('/user/select-interests', 'UserController@selectInterests')->name('home.user.select-interests');

	Route::group(['prefix' => 'collections', 'namespace' => 'Collections'], function () {
		Route::get('/sites/find', 'SiteFinderController@find');

		Route::get('/', 'CollectionController@index')->name('collections.index');
		Route::post('/', 'CollectionController@store')->name('collections.store');
		Route::post('/add-site/{collection_id}/{site_id}', 'CollectionController@addSite')->name('collections.add-site');

		Route::get('/sites', 'SiteController@index')->name('collections.sites.index');
		Route::get('/sites/random', 'SiteController@getRandomSites')->name('collections.sites.index');
		Route::get('/sites/articles/top', 'SiteController@topArticles')->name('collections.sites.top-articles');
		Route::get('/sites/saved-articles/count', 'SiteController@getCountSavedArticles');
		Route::get('/sites/articles/{article}', 'SiteController@clickAnArticle')->name('collections.sites.click-article');
		Route::post('sites/save-it-later/{article_id}', 'SiteController@saveItLater')->name('collections.sites.save-it-later');
		Route::post('sites/mark-as-read/{article_id}', 'SiteController@markAsRead')->name('collections.sites.mark-as-read');
		Route::get('sites/saved-articles', 'SiteController@getArticleSavedArticles')->name('collections.sites.saved-articles');
	});
});
