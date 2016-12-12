<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    /**
     * Associate Actor with Movie
     *
     * @return void
     */
    public function movies()
    {
        return $this->belongsToMany('P4\Movie')->withTimestamps();
    }


    public static function isNewActor($name)
    {
    	return is_null(Actor::where('name', "LIKE", $name)->first());
    }
}
