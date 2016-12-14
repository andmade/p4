@extends('layouts.master')
@section("content")
<div class="ink-grid">
    <div class="column-group push-center horizontal-gutters">
        <div class="all-50 medium-50 small-100 small-order-2">
            <section class="movie-details">
                
                <h2>{{$movie->title}}</h2>
                {{-- Available --}}
                @if ($movie->available)
                <button class="ink-button green">Available</button>
                @else
                <button class="ink-button red">Unavailable</button>
                @endif
                
                <h3>Released</h3>
                <p>{{$movie->released}}</p>
                
                {{-- Plot --}}
                <h3>Synopsis</h3>
                <p>{{$movie->synopsis}}</p>
                
                <h3>Director</h3>
                <ul>
                    @foreach ($movie->directors as $director)
                    <li>{{$director->name}}</li>
                    @endforeach
                </ul>
                
                
                <h3>Cast</h3>
                <ul>
                    @foreach ($movie->actors as $actor)
                    <li>{{$actor->name}}</li>
                    @endforeach
                </ul>
                
                <h3>Genres</h3>
                <ul>
                    @foreach ($movie->genres as $genre)
                    <li>{{$genre->name}}</li>
                    @endforeach
                </ul>
                
                
                
            </section>
        </div>
        <div class="all-30 medium-50 small-100 small-order-1">
            <section class="movie-poster">
                <img alt="Movie poster" src="{{$movie->poster}}" style="width:300px"/>
            </section>
        </div>
    </div>
</div>
@stop