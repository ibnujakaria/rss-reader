<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    public function categoryzable()
    {
    	return $this->morphTo();
    }

    public function users()
    {
    	return $this->morphedByMany('App\User', 'categoryzable');
    }

    public function sites()
    {
    	return $this->morphedByMany('App\User', 'categoryzable');
    }
}
