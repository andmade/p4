@extends('layouts.master')
@section("content")

<h2 class="all-100 fw-900">All Movies</h2>
<div class="ink-grid ink-flex">
    <div class="column-group push-left movies gutters">
        @foreach($movies as $movie)
        <section class="movie-card all-auto">
            <a href="/movies/{{$movie->id}}-{{$movie->url}}"><img alt="Movie poster" src="{{$movie->poster}}" style="max-width: 150px"/></a>
        </section>
        @endforeach
    </div>
    
</div>

@stop