<?php

use Illuminate\Database\Seeder;
use P4\Movie;
use P4\User;

class MovieUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed_user = User::where('email', '=', 'jamal@harvard.edu')->first();

        $seed_movies = ["10 Cloverfield Lane", "Snowpiercer"];

        foreach ($seed_movies as $movie_title) {
            $movie = Movie::where('title', 'LIKE', '%' . $movie_title . '%')->first();

            if ($movie->available) {
                $movie->users()->save($seed_user, [
                    'borrowed_at' => \Carbon\Carbon::today(),
                    'due_at'      => \Carbon\Carbon::today()->addWeeks(2),
                    'returned'    => false,
                ]);
                $movie->available = false;
                $movie->save();
            }
        }
    }
}
