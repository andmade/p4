<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{

	/**
     * Associate Director with Movie
     *
     * @return void
     */
    public function movies()
    {
        return $this->belongsToMany('P4\Movie')->withTimestamps();
    }


    public static function isNewDirector($name)
    {
    	return is_null(Director::where('name', "LIKE", $name)->first());
    }
}
