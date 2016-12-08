<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    public static function isNewDirector($name)
    {
    	return is_null(Director::where('name', "LIKE", $name)->first());
    }
}
