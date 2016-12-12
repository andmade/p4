<?php

use Illuminate\Database\Seeder;
use P4\Movie;
use P4\Genre;

class GenreMovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederMovies = array(
            "10 Cloverfield Lane"        => Movie::apiRetrieveGenre("10 Cloverfield Lane", 2016),
            "Queen of Katwe"             => Movie::apiRetrieveGenre("Queen of Katwe", 2016),
            "Captain America: Civil War" => Movie::apiRetrieveGenre("Captain America: Civil War", 2016),
            "The Perfect Score"          => Movie::apiRetrieveGenre("The Perfect Score", 2004),
            "Snowpiercer"                => Movie::apiRetrieveGenre("Snowpiercer", 2013),
            "Winter Soldier"             => Movie::apiRetrieveGenre("Winter Soldier", 2014),
        );

        foreach ($seederMovies as $seed_movie => $seed_genres) {

            $movie = Movie::where('title', 'LIKE', '%' . $seed_movie . '%')->first();

            // Get the ids of the movie directors from their names
            $seed_genres = array_map(function ($genre_name) {
                return Genre::where('name', 'LIKE', $genre_name)->first()->id;
            }, $seed_genres);

            // Sync the movie with its directors
            $movie->genres()->sync($seed_genres);
        };
    }
}
