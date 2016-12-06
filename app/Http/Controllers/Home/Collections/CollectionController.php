<?php

namespace App\Http\Controllers\Home\Collections;

use App\Models\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}
    
	/**
	* @param $request
	* 
	* this function is to create a collection, and we also can add a site accordingly
	* @return view()
	*/
    public function store(Request $request)
    {
    	Collection::newCollectionAndASite($request->collection_title, $request->site_id);
    }
}
