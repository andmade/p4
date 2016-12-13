<?php

namespace P4\Http\Controllers;

use Illuminate\Http\Request;
use P4\Director;
use P4\Movie;
use P4\Genre;
use Jleagle\Imdb\Imdb;
use Session;

require_once '../vendor/autoload.php';
// require_once '../../../apikey.php';

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $movies    = Movie::all();
        // dump($movies);
        $test = Imdb::retrieve('get on up', Imdb::TYPE_MOVIE, 2014);

        // dump($test);
        return view('admin.movies')->with('movies', $movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('movies.create')->with('genres', $genres);
    }
    /**
     * Process the request to search API for a movie.
     *
     * @return \Illuminate\Http\Response
     */

    public function apiMovieSearch(Request $request)
    {
        $found_movies = Imdb::search($request->createFormMovieTitle, Imdb::TYPE_MOVIE);

        return view('movies.create-ajax')->with('found_movies', $found_movies);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie_fragments = explode("-", $id);
        $movie_id = end($movie_fragments);

        $movie = Movie::find($movie_id);
        
        if(is_null($movie)) {
            Session::flash('message','Movie not found');
            return redirect('/admin/movies');
        }

        // dump($test);
        return view('movies.show')->with('movie', $movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
