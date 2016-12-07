<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("movies")->insert([
            "created_at" => Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon\Carbon::now()->toDateTimeString(),
            "title"      => "10 Cloverfield Lane",
            "released"   => 2016,
            "synopsis"   => "After getting in a car accident, a woman is held in a shelter with two men, who claim the outside world is affected by a widespread chemical attack.",
            "poster"     => "/img/posters/ten_cloverfield_lane.jpg",
            "available"  => true,
        ]);
        DB::table("movies")->insert([
            "created_at" => Carbon\Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon\Carbon::now()->toDateTimeString(),
            "title"      => "Queen of Katwe",
            "released"   => 2016,
            "synopsis"   => "A Ugandan girl sees her world rapidly change after being introduced to the game of chess.",
            "poster"     => "/img/posters/queen_of_katwe.jpg",
            "available"  => true,
        ]);DB::table("movies")->insert([
            "created_at" => Carbon\Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon\Carbon::now()->toDateTimeString(),
            "title"      => "Captain America: Civil War",
            "released"   => 2016,
            "synopsis"   => "A Ugandan girl sees her world rapidly change after being introduced to the game of chess.",
            "poster"     => "/img/posters/queen_of_katwe.jpg",
            "available"  => true,
        ]);DB::table("movies")->insert([
            "created_at" => Carbon\Carbon::now()->toDateTimeString(),
            "updated_at" => Carbon\Carbon::now()->toDateTimeString(),
            "title"      => "The Perfect Score",
            "released"   => 2016,
            "synopsis"   => "A Ugandan girl sees her world rapidly change after being introduced to the game of chess.",
            "poster"     => "/img/posters/queen_of_katwe.jpg",
            "available"  => true,
        ]);
    }
}
