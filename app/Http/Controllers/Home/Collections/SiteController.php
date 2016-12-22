<?php

namespace App\Http\Controllers\Home\Collections;

use Carbon\Carbon;
use App\Models\Site;
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
        $url = $request->get('site');
    	$user = auth()->user();

    	if ($url) {
    		$site = Site::url($url)->firstOrFail();

            $site->load(['articles' => function ($query) {
                $query->orderby('pub_date', 'desc')->paginate(15);
            }]);

            return response()->json(compact('site'));
    	} else {
            $articles = Article::whereHas('site', function ($query) use ($url) {
                $query->whereHas('collections', function ($query) use ($url) {
                    $query->whereHas('user', function ($query) {
                        $query->whereId(auth()->id());
                    });
                });
            });

            if ($request->has('type') and $request->type === 'today') {
                $articles->where('pub_date', '>=', Carbon::today()->toDateString());
            }

            $articles = $articles->orderby('pub_date', 'desc')->paginate(15)->appends($request->all());

            return response()->json(compact('articles')); 
    	}
    }

    public function saveItLater($article_id)
    {
        $article = Article::findOrFail($article_id); # this ensures that the id exists

        # this ensures that the article has not been saved
        if (auth()->user()->savedArticles()->where('article_id', $article_id)->first()) {
            return response()->json(['message' => 'already added'], 400);
        }
        auth()->user()->savedArticles()->attach($article->id, ['type' => 'saved_to_read_later']);

        return response()->json('success');
    }

    public function getArticleSavedArticles()
    {
        $articles = auth()->user()->savedArticles()->orderby('user_articles.id', 'desc')->paginate(15);
        return response()->json(compact('articles'));
    }
}
