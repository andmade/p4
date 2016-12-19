@extends('layouts.master')
@section("content")

<h2 class="all-100 fw-900">MovieMix: {{$movie_mix->name}}</h2>
<div class="ink-grid ink-flex">
    <div class="column-group push-left movies gutters">
        @foreach($movies as $movie)
        <section class="movie-card all-auto">
            <a href="/movies/{{$movie->id}}-{{$movie->url}}"><img alt="{{$movie->title}} poster" src="{{$movie->poster}}" style="max-width: 150px"/></a>
        </section>
        @endforeach
    </div>
    
</div>

@stop