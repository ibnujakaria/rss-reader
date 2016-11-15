<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function redirectToProvider($provider)
    {
    	return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
    	$userFromProvider = Socialite::driver($provider)->user();

    	# trying to login
    	$user = User::email($userFromProvider->email)->first();

    	if (!$user) {
    		$user = User::create([
    			'name' => $userFromProvider->name,
    			'email' => $userFromProvider->email,
    			'username' => $userFromProvider->nickname
    		]);
    	}

    	return response()->json($user);
    }
}
