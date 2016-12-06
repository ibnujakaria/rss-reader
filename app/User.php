<?php

namespace App;

use App\Models\Site;
use App\Models\Collection;
use App\Models\CollectionSite;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\Relation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    public function scopeEmail($query, $email)
    {
        return $query->whereEmail($email);
    }

    public function collections()
    {
        return $this->hasMany('App\Models\Collection');
    }
}
