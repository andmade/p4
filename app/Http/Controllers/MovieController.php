<?php

namespace P4\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Jleagle\Imdb\Imdb;
use P4\Actor;
use P4\Director;
use P4\Genre;
use P4\Movie;
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
        $movies = Movie::paginate(24);
        // dump($movies);
        $test = Imdb::retrieve('winter soldier', Imdb::TYPE_MOVIE, 2014);

        // dump(json_encode($test->toArray(), 0));
        return view('movies.index')->with('movies', $movies);
    }

    public function adminIndex()
    {

        $movies = Movie::all();
        // dump($movies);
        $test = Imdb::retrieve('winter soldier', Imdb::TYPE_MOVIE, 2014);

        // dump($test);
        $user = Auth::user();

        if ($user->can('create', Movie::class)) {
            $user = Auth::user();
            return view('admin.movies')->with('movies', $movies);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->can('create', Movie::class)) {
            $genres = Genre::all();
            return view('movies.create')->with('genres', $genres);
        } else {
            return view('index');
        }
    }

    /**
     * Process the request to search API for a movie.
     *
     * @return \Illuminate\Http\Response
     */

    public function apiMovieSearch(Request $request)
    {
        $found_movie = Movie::apiRetrieveMovie($request->movie_title, $request->movie_year);
        return json_encode($found_movie->toArray(), 0);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request!
        $this->validate($request, [
            'movie_title'    => 'required',
            'movie_released' => 'required|date_format:Y',
            'movie_synopsis' => 'required',
            'movie_director' => 'required',
            'movie_actors'   => 'required',
            'movie_genres'   => 'required',
        ]);

        // Make sure movie isn't already in database, kickback with flash message if it is
        $database_movie_match = Movie::where([
            ['title', '=', $request->movie_title],
            ['released', '=', $request->movie_released],
        ])->first();

        if ($database_movie_match) {
            Session::flash('message', 'Error: Movie is already in the database');
            return redirect('/admin/movies/create')->withInput();
        }

        // Add the movie
        $new_movie = new Movie();

        $new_movie->title     = $request->movie_title;
        $new_movie->released  = $request->movie_released;
        $new_movie->url       = str_slug($new_movie->title, "-");
        $new_movie->synopsis  = $request->movie_synopsis;
        $new_movie->poster    = Movie::apiRetrievePoster("https://images-na.ssl-images-amazon.com/images/M/MV5BMzA2NDkwODAwM15BMl5BanBnXkFtZTgwODk5MTgzMTE@._V1_SX600.jpg");
        $new_movie->available = true;
        $new_movie->save();

        // Get ids of directors and sync with movies, creating new directors if necessary
        $given_directors = explode(',', $request->movie_director);
        $director_ids    = collect($given_directors)->map(function ($given_director) {
            $database_director_match = Director::where('name', '=', trim($given_director))->first();

            if ($database_director_match) {
                return $database_director_match->id;
            } else {
                $new_director = new Director();

                $new_director->name = trim($given_director);
                $new_director->save();
                return $new_director->id;
            }
        });
        $new_movie->directors()->sync($director_ids->toArray());

        // Get ids of actors and sync with movies, creating new actors if necessary
        $given_actors = explode(', ', $request->movie_actors);
        $actors_ids   = collect($given_actors)->map(function ($given_actor) {
            $database_actor_match = Actor::where('name', '=', trim($given_actor))->first();

            if ($database_actor_match) {
                return $database_actor_match->id;
            } else {
                $new_actor = new Actor();

                $new_actor->name = trim($given_actor);
                $new_actor->save();
                return $new_actor->id;
            }
        });
        $new_movie->actors()->sync($actors_ids->toArray());

        // Sync genres with movies
        $new_movie->genres()->sync($request->movie_genres);

        Session::flash('message', 'Movie added!');
        return redirect('/admin/movies/create');
    }

/**
 * Display the specified resource.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function show($id, $slug)
    {
        $movie = Movie::find($id);

        // If movie doesn't exist, kickback
        if (is_null($movie)) {
            Session::flash('message', 'Movie not found');
            return back()->withInput();
        }

        // If id doesn't match slug url, redirect to right slug url
        if($slug != $movie->url) {
            return redirect('/movies/'.$id.'-'.$movie->url);
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
        $movie_fragments = explode("-", $id);
        $movie_id        = end($movie_fragments);
        $retrieved_movie = Movie::find($movie_id);

        $genres = Genre::all();
        return view('movies.edit')->with([
            'genres'          => $genres,
            'retrieved_movie' => $retrieved_movie,
        ]);
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
        // Validate the request!
        $this->validate($request, [
            'movie_title'    => 'required',
            'movie_released' => 'required|date_format:Y',
            'movie_synopsis' => 'required',
            'movie_director' => 'required',
            'movie_actors'   => 'required',
            'movie_genres'   => 'required',
        ]);

        // Update the movies
        $movie_fragments = explode("-", $id);
        $movie_id        = end($movie_fragments);
        $movie           = Movie::find($movie_id);

        $movie->title    = $request->movie_title;
        $movie->released = $request->movie_released;
        $movie->url      = str_slug($movie->title, "-");
        $movie->synopsis = $request->movie_synopsis;
        $movie->poster   = $movie->poster;
        $movie->save();

        // Get ids of directors and sync with movies, creating new directors if necessary
        $given_directors = explode(',', $request->movie_director);
        $director_ids    = collect($given_directors)->map(function ($given_director) {
            $database_director_match = Director::where('name', '=', trim($given_director))->first();
            if ($database_director_match) {
                return $database_director_match->id;
            } else {
                $new_director = new Director();

                $new_director->name = trim($given_director);
                $new_director->save();
                return $new_director->id;
            }
        });
        $movie->directors()->sync($director_ids->toArray());

        // Get ids of actors and sync with movies, creating new actors if necessary
        $given_actors = explode(', ', $request->movie_actors);
        $actors_ids   = collect($given_actors)->map(function ($given_actor) {
            $database_actor_match = Actor::where('name', '=', trim($given_actor))->first();

            if ($database_actor_match) {
                return $database_actor_match->id;
            } else {
                $new_actor = new Actor();

                $new_actor->name = trim($given_actor);
                $new_actor->save();
                return $new_actor->id;
            }
        });
        $movie->actors()->sync($actors_ids->toArray());

        // Get ids of actors and sync with movies
        $movie->genres()->sync($request->movie_genres);

        Session::flash('message', 'Movie updated!');
        return redirect('/admin/movies/');
    }

/**
 * Remove the specified resource from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\Response
 */
    public function destroy($id)
    {
        $movie_fragments = explode("-", $id);
        $movie_id        = end($movie_fragments);
        $movie           = Movie::find($movie_id);

        $movie->directors()->detach();
        $movie->actors()->detach();
        $movie->genres()->detach();
        $movie->delete();
        Session::flash('message', 'Movie deleted!');
        return redirect('/admin/movies/');
    }
}
