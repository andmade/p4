<?php

use Illuminate\Database\Seeder;
use P4\Movie;
use P4\Director;

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

            $movie = Movie::where('title', 'LIKE', '%'.$seed_movie.'%')->first();
            
            foreach ($seed_directors as $seed_director) {
                $director = Director::where('name', 'LIKE', $seed_director)->first();
                $movie->directors()->save($director);
            }
        }
    }
}
