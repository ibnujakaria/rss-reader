<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

	function __construct()
	{
		$this->middleware('user.has-interests');
	}

    public function index()
    {
    	return view('home.index');
    }
}
