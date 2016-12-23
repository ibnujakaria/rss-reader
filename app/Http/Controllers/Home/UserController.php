<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

	function __construct()
	{
		$this->middleware('auth');
	}

    public function selectInterests()
    {
    	return view('home.user.select-interests');
    }

    public function storeInterests(Request $request)
    {
    	foreach ($request->interests as $key => $id) {
    		auth()->user()->interests()->attach($id);
    	}
    	return response()->json($request->all());
    }
}
