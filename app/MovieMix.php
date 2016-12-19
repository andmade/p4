<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;

class MovieMix extends Model
{
	/**
     * Associate MovieMix with Users
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo('P4\User')->withTimestamps();
    }

/**
     * Associate MovieMix with Movies
     *
     * @return void
     */
    public function movies()
    {
        return $this->belongsToMany('P4\Movie')->withTimestamps();
    }
}
