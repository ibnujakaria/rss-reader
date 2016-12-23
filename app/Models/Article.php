<?php

namespace App\Models;

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
}
