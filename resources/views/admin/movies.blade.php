@extends('layouts.master')
@section("content")

@if(Session::has('message'))
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            <h1><strong>Heads Up!</strong> {!!Session::get('message')!!}</h1>
        </div>
    @endif
<div class="ink-grid">
    <div class="column-group">
        <div class="all-100 large-25">
            @foreach($movies as $movie)
            <section class="movies">
                <ul>
                    <li><a href="movies/{{$movie->url}}-{{$movie->id}}">{{$movie->title}}</a>
                </ul>
            </section>
            @endforeach
        </div>
    </div>
</div>
@stop
