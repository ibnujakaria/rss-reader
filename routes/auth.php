<?php

Route::group(['prefix' => 'auth'], function () {
	Route::get('/login/{provider}', 'Auth\AuthController@redirectToProvider');
	Route::get('/login/{provider}/callback', 'Auth\AuthController@handleProviderCallback')->name('auth.socialite.callback');
});