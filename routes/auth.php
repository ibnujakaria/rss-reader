<?php

Route::group(['prefix' => 'auth'], function () {
	Route::get('/login/{provider}', 'Auth\AuthController@redirectToProvider')->where('provider', 'facebook|twitter|google');
	Route::get('/login/{provider}/callback', 'Auth\AuthController@handleProviderCallback')->name('auth.socialite.callback')->where('provider', 'facebook|twitter|google');
});