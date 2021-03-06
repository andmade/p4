<?php

use Illuminate\Database\Seeder;
use P4\Movie;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederMovies = array(
            "10 Cloverfield Lane"        => 2016,
            "Queen of Katwe"             => 2016,
            "Captain America: Civil War" => 2016,
            "The Perfect Score"          => 2004,
            "Snowpiercer"                => 2013,
            "Winter Soldier"             => 2014,
        );

        foreach ($seederMovies as $title => $year) {
            $seed_movie = Movie::apiRetrieveMovie($title, $year);

            if (Movie::isNewMovie($seed_movie->title, $seed_movie->year)) {
                $movie            = new Movie();
                $movie->title     = $seed_movie->title;
                $movie->url       = str_slug($seed_movie->title, "-");
                $movie->released  = $seed_movie->year;
                $movie->synopsis  = $seed_movie->plot;
                $movie->poster    = Movie::apiRetrievePoster($seed_movie->poster);
                $movie->available = true;

                $movie->save();
            }
        };
    }
}
