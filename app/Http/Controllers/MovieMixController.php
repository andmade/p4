<?php

namespace P4\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use P4\Movie;
use P4\MovieMix;
use Session;

class MovieMixController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie_mixes = MovieMix::where('public', '=', true)->get();
        return view('moviemixes.index')->with('movie_mixes', $movie_mixes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'moviemix_title' => 'required',
        ]);

        if ($request->moviemix_title == 'new-mix') {
            $movie_mix       = new MovieMix();
            $movie_mix->name = $request->newmoviemix_title;

            $movie     = Movie::find($request->movie_id);
            $cover     = \Image::make(public_path($movie->poster))->crop(600, 600)->resize(100, 100);
            $file_name = str_random(10);
            $cover->save(public_path() . "/img/mixescovers/" . $file_name . ".jpg");
            $movie_mix->cover   = "/img/mixescovers/" . $file_name . ".jpg";
            $movie_mix->user_id = Auth::user()->id;

            if ($request->newmoviemix_public) {
                $movie_mix->public = true;
            } else {
                $movie_mix->public = false;
            }

            $movie_mix->save();
            $movie_mix->movies()->save($movie);

            Session::flash('success', 'Mix created and movie added!');
            return view('movies.show')->with("movie", $movie);
        } else {

            $movie_mix = MovieMix::find($request->moviemix_title);
            $movie = Movie::find($request->movie_id);
            $movie_mix->movies()->save($movie);
            Session::flash('success', 'Movie added to the mix!');
            return view('movies.show')->with("movie", $movie);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie_mix = MovieMix::find($id);

        $movies = $movie_mix->movies()->get();

        return view('moviemixes.show')->with([
            "movies"    => $movies,
            "movie_mix" => $movie_mix,
        ]);
    }

   
    public function destroy($id)
    {
        $movie_mix = MovieMix::find($id);
        $movie_mix->movies()->detach();
        $movie_mix->delete();
        Session::flash('success', 'MovieMix deleted!');
        return redirect('/account');
    }
}
