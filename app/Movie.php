<?php

namespace P4;

use Illuminate\Database\Eloquent\Model;
use Jleagle\Imdb\Imdb;

class Movie extends Model
{
/*Relationship Functions */
    /**
     * Associate Movie with Genre
     *
     * @return void
     */
    public function movie_mixes()
    {
        return $this->belongsToMany('P4\MovieMix')->withTimestamps();
    } 
    /**
     * Associate Movie with Genre
     *
     * @return void
     */
    public function genres()
    {
        return $this->belongsToMany('P4\Genre')->withTimestamps();
    }

     /**
     * Associate Movie with Actor
     *
     * @return void
     */
    public function actors()
    {
        return $this->belongsToMany('P4\Actor')->withTimestamps();
    } 

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
     * Associate Movie with User
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsToMany('P4\User')->withTimestamps()->withPivot('borrowed_at', 'due_at', 'returned');
    }

/*Query Functions*/
    /**
     * Check if movie is already in the database
     *
     * @return boolean
     */
    public static function isNewMovie($title, $year)
    {
        return is_null(Movie::where([
            ['title', 'LIKE', $title],
            ['released', 'LIKE', $year],
        ])->first());
    }

/* Api Functions*/

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
     * Retrieve Movie Directors from the api
     *
     * @return $directors (array of strings)
     */

    public static function apiRetrieveDirector($title, $year)
    {
        $movie     = Movie::apiRetrieveMovie($title, $year);
        $directors = explode(", ", $movie->director);
        return $directors;
    }

    /**
     * Retrieve Movie Actors from the api
     *
     * @return $actors (array of strings)
     */

    public static function apiRetrieveActor($title, $year)
    {
        $movie     = Movie::apiRetrieveMovie($title, $year);
        $actors = explode(", ", $movie->actors);
        return $actors;
    }

/**
     * Retrieve Movie Genres from the api
     *
     * @return $genres (array of strings)
     */

    public static function apiRetrieveGenre($title, $year)
    {
        $movie     = Movie::apiRetrieveMovie($title, $year);
        $genres = explode(", ", $movie->genre);
        return $genres;
    }

    /**
     * Retrieve Movie  Posters from the api
     *
     * @return $url (string)
     */
    public static function apiRetrievePoster($url)
    {
        $larger_img_url = str_replace("SX300", "SX600", $url);
        $img            = \Image::make($larger_img_url);

        $file_name = str_random(10);
        $img->save(public_path() . "/img/posters/" . $file_name . ".jpg");
        return "/img/posters/" . $file_name . ".jpg";
    }
}
