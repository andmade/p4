<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;
use P4\Movie;
use DB;

use Jleagle\Imdb\Imdb;
class Movie extends Model
{
    
    /**
     * Add a movie to the database
     *
     * @return void
     */
    public static function apiRetrieveMovie($title, $year) 
    {
    	$movie = Imdb::retrieve($title, Imdb::TYPE_MOVIE, $year);
    	return $movie;
    }

    public static function retrievePoster($url) {
    	$img = \Image::make($url);

    	$file_name = $string = str_random(10);
    	$img->save(public_path("/img/posters/" . $file_name . ".jpg"));
    	return "/img/posters/" . $file_name . ".jpg";
    }
}
