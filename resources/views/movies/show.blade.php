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
            
            @if (!$movie->available)
            <button class="ink-button red">Unavailable</button>
            @elseif (Auth::user())
            <button class="ink-button green" id="movieCheckOutTrigger">Check Out</button>
            @else
            <button class="ink-button green">Available</button>
            @endif
            
            @if (Auth::user())
            <button class="ink-button orange" id="movieAddMixTrigger">Add to MovieMix</button>
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
                    
                    <h3>Check out <em>{{$movie->title}}</em>?</h3>
                    <div style="text-align:right"><input type="submit"  class="ink-button green" value="Check Out"/></div>
                </form>
            </div>
        </div>
    </div>
    
    @if(Auth::user())
    <div class="ink-shade fade">
        <div class="ink-modal fade add-moviemix-modal" data-trigger="#movieAddMixTrigger" data-width="800px" data-height="400px" data-close-on-click="true" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
            <div class="modal-body add-moviemix-modal-body">
                <form class="ink-form ink-grid" method="POST" action="/moviemixes">
                    
                    {{ csrf_field() }}

                    {{ Form::hidden('movie_id', $movie->id)  }}
                    <?php $movie_mixes = Auth::user()->movie_mixes()->get(); ?>
                    <h3>Which moviemix would you like to add this movie to?</h3>
                    @if(Auth::user() && $movie_mixes)
                    <div class="control-group all-100">
                        <ul class="control unstyled">
                            @foreach($movie_mixes as $movie_mix)
                            <li><input id="movieMix{{$movie_mix->id}}" type="radio" name="moviemix_title" value="{{$movie_mix->id}}"><label for="movieMix{{$movie_mix->id}}">{{$movie_mix->name}}</label></li>
                            @endforeach
                            
                            <li><input id="newMixRadio" type="radio" name="moviemix_title" value="new-mix"><label for="newMixRadio">Create New Mix</label></li>
                            <input style="display:none" type="text" name="newmoviemix_title" id="newMixInputField"/>
                            <li><input style="display:none" type="checkbox" name="newmoviemix_public" id="newMixPublicField"/><label id="newMixPublicLabel" style="display:none" for="newMixPublicField">Make mix public?</label></li>
                        </ul>
                        <div style="text-align:right"><input type="submit"  class="ink-button green" value="Add"/></div>
                    </div>
                    @endif                    
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
@stop