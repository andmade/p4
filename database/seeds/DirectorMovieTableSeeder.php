<?php

use Illuminate\Database\Seeder;
use P4\Director;
use P4\Movie;

class DirectorMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederMovies = array(
            "10 Cloverfield Lane"        => Movie::apiRetrieveDirector("10 Cloverfield Lane", 2016),
            "Queen of Katwe"             => Movie::apiRetrieveDirector("Queen of Katwe", 2016),
            "Captain America: Civil War" => Movie::apiRetrieveDirector("Captain America: Civil War", 2016),
            "The Perfect Score"          => Movie::apiRetrieveDirector("The Perfect Score", 2004),
            "Snowpiercer"                => Movie::apiRetrieveDirector("Snowpiercer", 2013),
            "Winter Soldier"             => Movie::apiRetrieveDirector("Winter Soldier", 2014),
        );

        foreach ($seederMovies as $seed_movie => $seed_directors) {

            $movie = Movie::where('title', 'LIKE', '%' . $seed_movie . '%')->first();

            // Get the ids of the movie directors from their names
            $seed_directors = array_map(function($director_name) {
                return Director::where('name', 'LIKE', $director_name)->first()->id;
            }, $seed_directors);

            // Sync the movie with its directors
            $movie->directors()->sync($seed_directors);            
        };
    }
}
