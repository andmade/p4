<?php

namespace P4;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Associate User with MovieMix
     *
     * @return void
     */
    public function movie_mixes()
    {

        return $this->hasMany('P4\MovieMix');
    }
    /**
     * Associate User with Movie
     *
     * @return void
     */
    public function movies()
    {

        return $this->belongsToMany('P4\Movie')->withTimestamps()->withPivot('borrowed_at', 'due_at', 'returned');
    }
}
