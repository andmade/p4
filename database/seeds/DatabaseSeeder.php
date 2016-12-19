<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(MovieUserTableSeeder::class);
        
        $this->call(DirectorsTableSeeder::class);
        $this->call(DirectorMovieTableSeeder::class);

        $this->call(ActorsTableSeeder::class);
        $this->call(ActorMovieTableSeeder::class);

        $this->call(GenresTableSeeder::class);
        $this->call(GenreMovieTableSeeder::class);

        $this->call(RecommendationsTableSeeder::class);

        $this->call(MovieMixesTableSeeder::class);
        $this->call(MovieMovieMixTableSeeder::class);


    }
}
