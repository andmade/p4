<?php

use Illuminate\Database\Seeder;
use P4\Director;
use P4\Movie;

class DirectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $directors = ['Dan Trachtenberg', 'Anthony Russo', 'Joe Russo', 'Mira Nair', 'Joon-ho Bong', 'Brian Robbins'];

        $seederMovies = array(
            "10 Cloverfield Lane"        => 2016,
            "Queen of Katwe"             => 2016,
            "Captain America: Civil War" => 2016,
            "The Perfect Score"          => 2004,
            "Snowpiercer"                => 2013,
            "Winter Soldier"             => 2014,
        );

        foreach ($seederMovies as $title => $year) {

            $seed_movie     = Movie::apiRetrieveMovie($title, $year);
            $seed_directors = explode(", ", $seed_movie->director);

            foreach ($seed_directors as $seed_director) {
                if (Director::isNewDirector($seed_director)) {
                    $director       = new Director();
                    $director->name = $seed_director;

                    $director->save();
                } else {
                    print_r("Already there!");
                }
            };
        };
    }
}
