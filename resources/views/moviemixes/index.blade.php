@extends('layouts.master')
@section("content")

<h2 class="all-100 fw-900">All MovieMixes</h2>
<div class="ink-grid ink-flex">
    <div class="column-group push-left gutters all-100">
        @foreach($movie_mixes as $movie_mix)
        
        <section class="movie-mix-card all-auto">
            <img src={{$movie_mix->cover}} class="all-20"/>
            <a href="/moviemixes/{{$movie_mix->id}}"><span class="fw-700 all-80">{{$movie_mix->name}}</span></a>
        </section>
        @endforeach
    </div>
    
</div>

@stop