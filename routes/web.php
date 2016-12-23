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
		Route::get('/sites/find', 'SiteFinderController@find');

		Route::get('/', 'CollectionController@index')->name('collections.index');
		Route::post('/', 'CollectionController@store')->name('collections.store');
		Route::post('/add-site/{collection_id}/{site_id}', 'CollectionController@addSite')->name('collections.add-site');

		Route::get('/sites', 'SiteController@index')->name('collections.sites.index');
		Route::get('/sites/articles/top', 'SiteController@topArticles')->name('collections.sites.top-articles');
		Route::get('/sites/articles/{article}', 'SiteController@clickAnArticle')->name('collections.sites.click-article');
		Route::post('sites/save-it-later/{article_id}', 'SiteController@saveItLater')->name('collections.sites.save-it-later');
		Route::get('sites/saved-articles', 'SiteController@getArticleSavedArticles')->name('collections.sites.saved-articles');
	});
});
