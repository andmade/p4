<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Homepage
Route::get('/', "PageController@Home")->name("homepage");

//Public Movie Resource Routes
Route::get("/movies", "MovieController@index")->name("movies.index");
Route::get("/movies/{id}-{slug}", "MovieController@show")->name("movies.show");

//Regular User Movie Routes/Functions
Route::get("/account", "UserController@showDashboard")->name("user.dashboard")->middleware('auth');
Route::post("/movies/{id}/checkout", "UserController@checkoutMovie")->middleware('auth');
Route::post("/movies/{id}/return", "UserController@returnMovie")->middleware('can:create,P4\Movie');


// Private (Admin Only) Movie Resource Routes
Route::get("/admin/movies", "MovieController@adminIndex")->middleware('can:create,P4\Movie');
Route::get("/admin/movies/create", "MovieController@create")->middleware('can:create,P4\Movie');
Route::post("/admin/movies/", "MovieController@store")->middleware('can:create,P4\Movie');
Route::get("/admin/movies/{id}-{slug}", "MovieController@show")->middleware('can:create,P4\Movie');
Route::get("/admin/movies/{id}-{slug}/edit", "MovieController@edit")->middleware('can:create,P4\Movie');
Route::put("/admin/movies/{id}-{slug}/", "MovieController@update")->middleware('can:create,P4\Movie');
Route::delete("/admin/movies/{id}-{slug}", "MovieController@destroy")->middleware('can:create,P4\Movie');
#Ajax Movie Match Route
Route::post("/admin/movies/create", "MovieController@apiMovieSearch")->middleware('can:create,P4\Movie'); 

//MovieMix Resource Routes
Route::get("/moviemixes", "MovieMixController@index")->name("moviemixes.index");
Route::get("/moviemixes/create", "MovieMixController@create")->name("moviemixes.create");
Route::post("/moviemixes", "MovieMixController@store")->name("moviemixes.store");
Route::get("/moviemixes/{id}", "MovieMixController@show")->name("moviemixes.show");
Route::get("/moviemixes/{id}/edit", "MovieMixController@edit")->name("moviemixes.edit");
Route::put("/moviemixes/{id}", "MovieMixController@update")->name("moviemixes.update");
Route::delete("/moviemixes/{id}", "MovieMixController@destroy")->name("moviemixes.destroy");

//Recommendations Pages
Route::get("/account/recommend/", "RecommendationController@index")->name("recommendations.index")->middleware('auth');
Route::get("/account/recommend/create", "RecommendationController@create`")->name("recommendations.create")->middleware('auth');
Route::post("/account/recommend/", "RecommendationController@store")->name("recommendations.store");


Auth::routes();
Route::get('/logout','Auth\LoginController@logout')->name('logout');

// Debug Routes
if(App::environment('local')) {

    Route::get('/drop', function() {
    	File::deleteDirectory(public_path() . "/img/posters");
        File::deleteDirectory(public_path() . "/img/mixescovers");
        DB::statement('DROP database p4');
        DB::statement('CREATE database p4');

        return 'Dropped and recreated database';
    });

};

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});

Route::get('/show-login-status', function() {

    # You may access the authenticated user via the Auth facade
    $user = Auth::user();

    if($user)
        dump($user->toArray());
    else
        dump('You are not logged in.');

    return;
});
