<?php

namespace P4\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use P4\Movie;

class UserController extends Controller
{
    public function showDashboard($id) {
        return view('welcome');
    }

    public function checkoutMovie($movie_id)
    {
        $user  = Auth::user();
        $movie = Movie::find($movie_id);

        if ($movie->available) {
            $movie->users()->save($user, [
                'borrowed_at' => \Carbon\Carbon::today()->toDateTimeString(),
                'due_at' => \Carbon\Carbon::today()->addWeeks(2)->toDateTimeString(),
                'returned' => false,
            ]);
            $movie->available = false;
            $movie->save();
            Session::flash('message', 'Movie successfully checked out');
            return view('movies.show')->with("movie", $movie);
        }
    }
}
