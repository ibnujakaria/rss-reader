<?php

Route::group(['prefix' => 'auth'], function () {
	Route::get('/', 'Auth\AuthController@index')->name('auth.index');
	Route::get('/login/{provider}', 'Auth\AuthController@redirectToProvider')->where('provider', 'facebook|twitter|google')->name('auth.login');
	Route::get('/login/{provider}/callback', 'Auth\AuthController@handleProviderCallback')->name('auth.socialite.callback')->where('provider', 'facebook|twitter|google');

	Route::get('/logout', 'Auth\AuthController@logout')->name('auth.logout');
});