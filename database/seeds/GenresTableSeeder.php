<?php

use Illuminate\Database\Seeder;
use P4\Genre;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seed_genres = ['Action', 'Adventure', 'Animation', 'Biography', 'Comedy', 'Crime', 'Documentary', 'Drama', 'Family',
            'Fantasy', 'Film-Noir', 'History', 'Horror', 'Music', 'Musical', 'Mystery', 'Romance', 
            'Sci-Fi', 'Sport', 'Thriller', 'War', 'Western'];


        foreach($seed_genres as $seed_genre){
        	if (!Genre::where('name', 'LIKE', $seed_genre)->first()) {
        		$genre = new Genre();

        		$genre->name = $seed_genre;
        		$genre->save();
        	}
        }


    }
}
