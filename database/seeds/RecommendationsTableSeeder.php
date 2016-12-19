<?php

use Illuminate\Database\Seeder;
use P4\Recommendation;

class RecommendationsTableSeeder extends Seeder
{
/**
 * Run the database seeds.
 *
 * @return void
 */
    public function run()
    {
        $seed_recommendations = [
            "the matrix" => 1999,
            "moonlight"  => 2016,
            "belle"      => 2013,
        ];

        foreach ($seed_recommendations as $seed_title => $seed_released) {
            $recommendation = new Recommendation();

            $recommendation->title    = $seed_title;
            $recommendation->released = $seed_released;
            $recommendation->save();
        }
    }
}
