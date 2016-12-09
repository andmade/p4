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
        // $this->call(UsersTableSeeder::class);
        $this->call(MoviesTableSeeder::class);
        $this->call(DirectorsTableSeeder::class);
        $this->call(DirectorMovieTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
