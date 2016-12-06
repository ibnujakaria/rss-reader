<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
* Its just a bridge of Collection and Site
*/

class CollectionSite extends Model
{

	protected $fillable = ['collection_id', 'site_id'];

    public function data()
    {
    	return $this->hasOne('App\Models\Site');
    }

    public function collection()
    {
    	return $this->belongsTo('App\Models\Collection');
    }
}
