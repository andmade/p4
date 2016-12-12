@extends('layouts.master')
@section("content")
<div class="ink-grid">
    <div class="column-group push-center">
        <div class="all-33 medium-50 small-100 small-order-2">
            <section class="movie-details">
                <ul>
                    {{-- Title --}}
                    <h2>
                        {{$movie->title}}
                    </h2>
                    {{-- Year --}}
                    <h3>
                        {{$movie->released}}
                    </h3>
                    {{-- Plot --}}
                    <p>
                        {{$movie->synopsis}}
                    </p>
                    {{-- Director --}}
                    @foreach ($movie->directors as $director)
                    <h2>
                        {{$director->name}}
                    </h2>
                    @endforeach
                    {{-- Cast --}}
                    @foreach ($movie->actors as $actor)
                    <h2>
                        {{$actor->name}}
                    </h2>
                    @endforeach
                    {{-- Genre --}}
                    @foreach ($movie->genres as $genre)
                    <h2>
                        {{$genre->name}}
                    </h2>
                    @endforeach

                    {{-- Available --}}
                    @if ($movie->available)
                        <button class="ink-button green">Available</button>
                    @else
                        <button class="ink-button red">Unavailable</button>
                    @endif
                </ul>
            </section>
        </div>
        <div class="all-33 medium-50 small-100 small-order-1">
            <section class="movie-poster">
                <img alt="" src="{{$movie->poster}}" style="width:300px"/>
            </section>
        </div>
    </div>
</div>
@stop
