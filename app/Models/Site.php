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

    public function scopeUrl($query, $url)
    {
        return $query->where('url', 'like', "%{$url}");
    }
}
