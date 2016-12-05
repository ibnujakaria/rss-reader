<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    public function index()
    {
        return view('auth.index');
    }

    public function redirectToProvider($provider)
    {
    	return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
    	$userFromProvider = Socialite::driver($provider)->user();

    	# check if the user with this email exists
    	$user = User::email($userFromProvider->email)->first();

    	if (!$user) {
    		$user = User::create([
    			'name' => $userFromProvider->name,
    			'email' => $userFromProvider->email,
    			'username' => $userFromProvider->nickname
    		]);
    	}

        \Auth::login($user);

    	return redirect()->route('home.index');
    }

    public function logout()
    {
        \Auth::logout();

        return redirect()->route('auth.index');
    }
}
