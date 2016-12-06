<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

	protected $fillable = ['user_id', 'title'];
    
    public function sites()
    {
    	return $this->hasMany('App\CollectionSite');
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
}
