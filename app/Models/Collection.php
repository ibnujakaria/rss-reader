<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

	protected $fillable = ['user_id', 'title'];
    
    public function sites()
    {
    	return $this->belongsToMany('App\Models\Site', 'collection_sites');
    }


    public static function newCollectionAndASite($collectionTitle, $siteId = null)
    {
    	$collection = Collection::create([
    		'user_id' => auth()->user()->id,
    		'title'	=> $collectionTitle
    	]);

    	if ($siteId) {
	    	$collectionSite = CollectionSite::create([
	    		'collection_id' => $collection->id,
	    		'site_id' => $siteId
	    	]);
    	}

    	return $collection;
    }

    public static function addSite($collection_id, $site_id)
    {
    	$collection = auth()->user()->collections()->find($collection_id);

    	# check if the sites is not already added
    	if ($collection->sites()->find($site_id)) {
    		return false;
    	}

    	CollectionSite::create([
    		'collection_id' => $collection_id,
    		'site_id' => $site_id
    	]);

    	return true;
    }
}
