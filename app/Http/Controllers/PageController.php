<?php

namespace P4\Http\Controllers;

use Illuminate\Http\Request;

use P4\Movie;

class PageController extends Controller
{
     /**
     * Display the home page
     *
     * @return \Illuminate\Http\Response
     */
    public function Home()
    {

    	$recent_movies = Movie::orderBy('created_at', 'desc')->take(6)->get();
        return view('index')->with("recent_movies", $recent_movies);
    }

}
