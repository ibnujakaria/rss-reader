<?php

namespace App\Http\Controllers\Home\Collections;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    

    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index(Request $request)
    {
        $site = $request->get('site');
    	$user = auth()->user();

    	if ($site) {
    		$entries = $user->collections()->whereHas('sites', function ($query) use ($site) {
    			$query->url($site);
    		})->with(['sites' => function ($query) use ($site) {
                $query->url($site);
                $query->with(['articles' => function ($query) use ($site) {
                    $query->orderby('pub_date', 'desc');
                }]);
    		}])->first();

            $site = $entries->sites[0];

            return response()->json(compact('site'));
    	} else {
            $articles = Article::whereHas('site', function ($query) use ($site) {
                $query->whereHas('collections', function ($query) use ($site) {
                    $query->whereHas('user', function ($query) {
                        $query->whereId(auth()->id());
                    });
                });
            })->orderby('pub_date', 'desc')->get();

            return response()->json(compact('articles')); 
    	}
    }
}
