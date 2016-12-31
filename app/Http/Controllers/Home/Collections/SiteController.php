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
                $query->with('site')->orderby('pub_date', 'desc')->paginate(15);
            }]);

            return response()->json(compact('site'));
    	} else {
            $articles = Article::with('site')->whereHas('site', function ($query) use ($url) {
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

    /**
    * this function is used to monitor the clicked articles.
    * then the data is used to get top articles
    */
    public function clickAnArticle(Article $article)
    {
        auth()->user()->clickedArticles()->attach($article->id, ['type' => 'clicked']);

        return response()->json(['message' => 'action recorded.']);
    }

    /**
    * this function is to get the top articles
    * the top articles is sorted by the count of clicked by the users
    */
    public function topArticles()
    {
        $articles = Article::select([
            '*',
            \DB::raw('(select count(*) from user_articles where article_id = articles.id and type="clicked") as clicks_count')
        ])->whereHas('usersWhoClick')->with(['site', 'usersWhoClick'])->orderBy('clicks_count', 'desc')->paginate(15);

        return response()->json(compact('articles')); 
    }

    public function saveItLater($article_id)
    {
        $article = Article::findOrFail($article_id); # this ensures that the id exists

        # this ensures that the article has not been saved
        if (auth()->user()->savedArticles()->where('article_id', $article_id)->first()) {
            return response()->json(['message' => 'already added'], 400);
        }
        auth()->user()->savedArticles()->attach($article->id, ['type' => 'saved_to_read_later']);

        return response()->json(['message' => 'success']);
    }

    public function markAsRead($article_id)
    {
        $result = auth()->user()->savedArticles()->detach($article_id);

        return response()->json([
            'success' => (bool) $result
        ]);
    }

    public function getArticleSavedArticles()
    {
        $articles = auth()->user()->savedArticles()->with('site')->orderby('user_articles.id', 'desc')->paginate(15);
        return response()->json(compact('articles'));
    }

    public function getCountSavedArticles()
    {
      $articlesCount = auth()->user()->savedArticles()->count();
      return response()->json($articlesCount);
    }

    public function getRandomSites()
    {
        $sites = Site::orderBy(\DB::raw('rand()'))->get();

        return response()->json(compact('sites'));
    }
}
