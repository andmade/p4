<?php

namespace P4\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use P4\Movie;
use P4\User;
use Session;

class UserController extends Controller
{
    public function showDashboard()
    {

        $user          = Auth::user();
        $loaned_movies = User::find($user->id)->movies()->where('returned', '=', false)->get();
        // dump($loaned_movies);
        $movie_mixes = \P4\MovieMix::where('user_id','=', 2)->first();
        // dump($movie_mixes);
        return view('user.dashboard')->with("loaned_movies", $loaned_movies);
    }

    public function checkoutMovie($movie_id)
    {
        $user  = Auth::user();
        $movie = Movie::find($movie_id);

        if ($movie->available) {
            $movie->users()->save($user, [
                'borrowed_at' => \Carbon\Carbon::today(),
                'due_at'      => \Carbon\Carbon::today()->addWeeks(2),
                'returned'    => false,
            ]);
            $movie->available = false;
            $movie->save();
            Session::flash('success', 'Movie successfully checked out');
            return view('movies.show')->with("movie", $movie);
        }
    }
    public function returnMovie($movie_id)
    {
        $user  = Auth::user();
        $movie = $user->movies->where('id', '=', $movie_id)->first();

        if ($movie) {
            $user->movies()->updateExistingPivot($movie_id, ['returned' => true]);
            $movie->available = true;
            $movie->save();
            $user->save();
            Session::flash('success', 'Movie returned!');
            return back()->withInput();
        } else {
            Session::flash('error', 'Movie not checked out.');
            return back();
        }
    }
}
