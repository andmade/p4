<?php

use Illuminate\Database\Seeder;
use P4\Movie;
use P4\Actor;

class ActorMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederMovies = array(
            "10 Cloverfield Lane"        => Movie::apiRetrieveActor("10 Cloverfield Lane", 2016),
            "Queen of Katwe"             => Movie::apiRetrieveActor("Queen of Katwe", 2016),
            "Captain America: Civil War" => Movie::apiRetrieveActor("Captain America: Civil War", 2016),
            "The Perfect Score"          => Movie::apiRetrieveActor("The Perfect Score", 2004),
            "Snowpiercer"                => Movie::apiRetrieveActor("Snowpiercer", 2013),
            "Winter Soldier"             => Movie::apiRetrieveActor("Winter Soldier", 2014),
        );

        foreach ($seederMovies as $seed_movie => $seed_actors) {

            $movie = Movie::where('title', 'LIKE', '%' . $seed_movie . '%')->first();

            // Get the ids of the movie directors from their names
            $seed_actors = array_map(function ($actor_name) {
                return Actor::where('name', 'LIKE', $actor_name)->first()->id;
            }, $seed_actors);

            // Sync the movie with its directors
            $movie->actors()->sync($seed_actors);
        };
    }
}
