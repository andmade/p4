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
Route::get('/', function () {
    return view('welcome');
});

//Public Movie Resource Routes
Route::get("/movies", "MovieController@index")->name("movies.index");
Route::get("/movies/show", "MovieController@show")->name("movies.show");

// Private (Admin Only) Movie Resource Routes
Route::get("/admin/movies", "MovieController@index")->name("movies.index");
Route::get("/admin/movies/create", "MovieController@create")->name("movies.create");
Route::post("/admin/movies/create", "MovieController@store")->name("movies.store");
Route::get("/admin/movies/show", "MovieController@show")->name("movies.show");
Route::get("/admin/movies/{movie}/edit", "MovieController@edit")->name("movies.edit");
Route::put("/admin/movies/{movie}/edit", "MovieController@update")->name("movies.update");
Route::delete("/admin/movies/{movie}", "MovieController@destory")->name("movies.destroy");

//Queue Resource Routes
Route::get("/account/queues", "QueueController@index")->name("queues.index");
Route::get("/account/queues/create", "QueueController@create")->name("queues.create");
Route::post("/account/queues", "QueueController@store")->name("queues.store");
Route::get("/account/queues/{queue}", "QueueController@show")->name("queues.show");
Route::get("/account/queues/{queue}/edit", "QueueController@edit")->name("queues.edit");
Route::put("/account/queues/{queue}", "QueueController@update")->name("queues.update");
Route::delete("/account/queues/{queue}", "QueueController@destroy")->name("queues.destroy");


// Debug Routes
if(App::environment('local')) {

    Route::get('/drop', function() {
    	File::deleteDirectory(public_path() . "/img/posters");
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
Auth::routes();

Route::get('/home', 'HomeController@index');
