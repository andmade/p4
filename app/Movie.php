<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;
use Jleagle\Imdb\Imdb;

class Movie extends Model
{

    /**
     * Associate Movie with Director
     *
     * @return void
     */
    public function directors()
    {
        return $this->belongsToMany('P4\Director')->withTimestamps();
    }

    /**
     * Retrieve Movie Details from the api
     *
     * @return $movie (array of string key->value pairs)
     */
    public static function apiRetrieveMovie($title, $year)
    {
        $movie = Imdb::retrieve($title, Imdb::TYPE_MOVIE, $year);
        return $movie;
    }

    /**
     * Retrieve Movie Details from the api
     *
     * @return $seed_directors (array of strings)
     */

    public static function apiRetrieveDirector($title,$year) {
        $seed_movie     = Movie::apiRetrieveMovie($title, $year);
        $seed_directors = explode(", ", $seed_movie->director);
        return $seed_directors;
    }

    public static function retrievePoster($url)
    {
        $img = \Image::make($url);

        $file_name = str_random(10);
        $img->save(public_path() . "/img/posters/" . $file_name . ".jpg");
        return "/img/posters/" . $file_name . ".jpg";
    }
}
