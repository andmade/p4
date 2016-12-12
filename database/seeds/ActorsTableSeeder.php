<?php

use Illuminate\Database\Seeder;
use P4\Actor;
use P4\Movie;

class ActorsTableSeeder extends Seeder
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

            $seed_movie  = Movie::apiRetrieveMovie($title, $year);
            $seed_actors = explode(", ", $seed_movie->actors);

            foreach ($seed_actors as $seed_actor) {
                if (Actor::isNewActor($seed_actor)) {
                    $actor       = new Actor();
                    $actor->name = $seed_actor;

                    $actor->save();
                }
            };
        };
    }
}
