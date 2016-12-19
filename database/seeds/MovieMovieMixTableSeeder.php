<?php

use Illuminate\Database\Seeder;
use P4\MovieMix;
use P4\Movie;

class MovieMovieMixTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_movies  = [1, 2];
        $second_movies = [3,4,5,6];

        $first_mix = MovieMix::find(1);

        $first_cover = \Image::make(public_path(Movie::find(1)->poster))->crop(600, 600)->resize(100, 100);
        $first_file_name = str_random(10);
        $first_cover->save(public_path() . "/img/mixescovers/" . $first_file_name . ".jpg");
        $first_mix->cover = "/img/mixescovers/" . $first_file_name . ".jpg";
        $first_mix->movies()->sync($first_movies);
        $first_mix->save();

        $second_mix = MovieMix::find(2);        
        $second_cover = \Image::make(public_path(Movie::find(3)->poster))->crop(600, 600)->resize(100, 100);
        $second_file_name = str_random(10);
        $second_cover->save(public_path() . "/img/mixescovers/" . $second_file_name . ".jpg");
        $second_mix->cover = "/img/mixescovers/" . $second_file_name . ".jpg";
        $second_mix->movies()->sync($second_movies);
        $second_mix->save();

    }
}
