<?php

use Illuminate\Database\Seeder;
use P4\MovieMix;
use P4\User;

class MovieMixesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $first_movies  = ["Queen of Katwe", "10 Cloverfield Lane"];
        // $second_movies = ["Winter Soldier", "Snowpiercer", "Captain America: Civil War", "The Perfect Score"];
        $mixes = ["Awesome Mix, Vol. 1", "Chris Evans Mega-MovieMix!!!"];
        $user_id = User::where('email', '=', 'jamal@harvard.edu')->pluck('id')->first();

        $first_match = MovieMix::where('name', '=', $mixes[0])->first();
        if (!$first_match) {
            $first_mix         = new MovieMix();
            $first_mix->name   = $mixes[0];
            $first_mix->public = false;
            $first_mix->user_id = $user_id;
            $first_mix->save();
        }

        $second_match = MovieMix::where('name', '=', $mixes[1])->first();
        if (!$second_match) {
            $second_mix         = new MovieMix();
            $second_mix->name   = $mixes[1];
            $second_mix->public = true;
            $second_mix->user_id = $user_id;
            $second_mix->save();
        }
    }
}
