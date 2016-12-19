<?php

namespace P4\Http\Controllers;

use Illuminate\Http\Request;
use P4\Recommendation;
use Session;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.recommend');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.recommend');
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
        ]);

        $recommendation = new Recommendation();
        $recommendation->title = $request->movie_title;
        $recommendation->released = $request->movie_released;
        $recommendation->save();

        Session::flash('message', 'Movie recommendation added!');
        return redirect('/account/recommend');

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
