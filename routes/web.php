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
Route::get("/movies", "MovieController@show")->name("movies.show");

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
Route::destroy("/account/queues/{queue}", "QueueController@destroy")->name("queues.destroy");