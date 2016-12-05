<?php

namespace App\Http\Controllers\Home\Collections;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteFinderController extends Controller
{
    
    public function find(Request $request)
    {
    	$result = file_get_contents("http://ajax.googleapis.com/ajax/services/feed/lookup?v=1.0&q={$request->site}");
    	$result = json_decode($result);

    	if ($result->responseStatus === 200) {
    		$site = Site::findByFeedURL($result->responseData->url);

    		return response()->json($site);
    	}

    	return response()->json($result);
    }
}
