@extends('layouts.master')
@section("content")
<div class="ink-grid">
    <div class="column-group push-center horizontal-gutters">
        <div class="all-50 medium-50 small-100 small-order-2">
            <section class="movie-details">
                
                <h2 class="movie-details-title">{{$movie->title}}</h2>
                {{-- Available --}}
                <p><span class="movie-details-released">{{$movie->released}} |</span> 
                @foreach ($movie->genres as $genre)
                <span class="movie-details-genre ink-badge">{{$genre->name}}</span>
                @endforeach
            </p>
            
            <p class="movie-details-synopsis">{{$movie->synopsis}}</p>
            
            <h3>Director</h3>
            <ul class="unstyled">
                @foreach ($movie->directors as $director)
                <li class="movie-details-director">{{$director->name}}</li>
                @endforeach
            </ul>
            
            
            <h3>Cast</h3>
            <ul class="unstyled">
                @foreach ($movie->actors as $actor)
                <li class="movie-details-actor">{{$actor->name}}</li>
                @endforeach
            </ul>
            
            @if (Auth::user())
            <button class="ink-button green" id="movieCheckOutTrigger">Check Out</button>
            @elseif ($movie->available)
            <button class="ink-button green">Available</button>
            @else
            <button class="ink-button red">Unavailable</button>
            @endif
        </section>
    </div>
    
    <div class="all-30 medium-50 small-100 small-order-1">
        <section class="movie-details-poster">
            <img alt="Movie poster" src="{{$movie->poster}}"/>
        </section>
    </div>
    
    <div class="ink-shade fade">
        <div class="ink-modal fade checkout-movie-modal" data-trigger="#movieCheckOutTrigger" data-width="800px" data-height="150px" data-close-on-click="true" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
            <div class="modal-body delete-movie-modal-body">
                <form class="ink-form" method="POST" action="/movies/{{$movie->id}}/checkout">
                    
                    
                    {{ csrf_field() }}
                    
                    <h2>Check out <em>{{$movie->title}}</em>?</h2>
                    <div style="text-align:right"><input type="submit"  class="ink-button green" id="detailFormMovieSubmitButton" value="Check Out"/></div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@stop