<?php

namespace App\Models;

use App\Libraries\RssFinder;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function collections()
    {
        return $this->belongsToMany('App\Models\Collection', 'collection_sites');
    }

    public static function findByFeedURL($url)
    {
    	$site = Site::where('feed_url', $url)->first();

    	if (!$site) {
	    	$result = RssFinder::read($url);

    		$site = new Site;
    		$site->title = $result->site->title;
    		$site->url = $result->site->link;
    		$site->feed_url = $result->site->feed_url;
    		$site->description = $result->site->description;
    		$site->last_synced = $result->site->last_synced;
    		$site->save();

    		# store the articles
    		foreach ($result->articles as $key => $entry) {
    			$article = new Article;
    			$article->site_id = $site->id;
    			$article->title = $entry->title;
    			$article->link = $entry->link;
    			$article->description = $entry->description;
    			$article->author = $entry->author;
    			$article->pub_date = $entry->pub_date;
    			$article->save();
    		}
    	}

    	return $site;
    }

    public static function grabNewestArticlesOf($url)
    {
        $site = static::url($url)->first();

        $result = RssFinder::read($site->feed_url);

        // echo $result->site->last_synced . " -- " . $site->last_synced . "\n";
        if ($result->site->last_synced !== $site->last_synced && strtotime($result->site->last_synced) > strtotime($site->last_synced)) {
            # grab the new articles

            $articlesToStore = collect([]);
            $lastArticleOfTheSite = $site->articles()->orderby('pub_date', 'desc')->first();

            foreach ($result->articles as $key => $entry) {
                if (strtotime($entry->pub_date) > strtotime($lastArticleOfTheSite->pub_date)) {
                    $articlesToStore->push($entry);
                } else {
                    break;
                }
            }

            # reverse the articles
            $articlesToStore = $articlesToStore->reverse();

            foreach ($articlesToStore as $key => $entry) {
                $article = new Article;
                $article->site_id = $site->id;
                $article->title = $entry->title;
                $article->link = $entry->link;
                $article->description = $entry->description;
                $article->author = $entry->author;
                $article->pub_date = $entry->pub_date;
                $article->save();
            }

            $site->last_synced = $result->site->last_synced;
            $site->save();

            return true;
        }

        return false;
    }

    public function scopeUrl($query, $url)
    {
        return $query->where('url', 'like', "%{$url}");
    }
}
