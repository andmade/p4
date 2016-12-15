@extends('layouts.master')
@section("content")


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