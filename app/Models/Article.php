<?php

namespace App\Models;

use GuzzleHttp\Client;
use Goose\Client as GooseClient;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    

    public function site()
    {
    	return $this->belongsTo("App\Models\Site");
    }

    public function usersWhoClick()
    {
    	return $this->belongsToMany('App\User', 'user_articles')->wherePivot('type', 'clicked')->withTimestamps();
    }

    public function getAndKeepTheDetail()
    {
    	$client = new Client();

    	$response = $client->request('GET', 'https://mercury.postlight.com/parser', [
    		'query' => [
    			'url' => $this->link
    		],
    		'headers' => [
    			'x-api-key' => 'WRJE1I2cn0Zjb1vWyDhwAZ09tJXMTij5Ct33fSrZ'
    		]
    	]);

    	if ($response->getStatusCode() === 200) {
    		$detail = json_decode($response->getBody());
	    	$this->body = $detail->content;
	    	$this->picture = $detail->lead_image_url;
	    	$this->grabbed = 1;
	    	$this->save();
    	}

    	return $this;
    }

    public function scopeNoDetail($query)
    {
    	return $query->where('grabbed', 0);
    }
}
