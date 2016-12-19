@extends('layouts.master')
@section("content")


<div class="ink-tabs left ink-grid" data-prevent-url-change="true">
    <!-- If you're using 'bottom' positioning, put this div AFTER the content. -->
    <ul class="tabs-nav">
        <li><a class="tabs-tab" href="#usersMoviesTab">Loans</a></li>
        <li><a class="tabs-tab" href="#usersMixesTab">MovieMixes</a></li>
    </ul>
    
    <!-- Now just place your content -->
    <div id="usersMoviesTab" class="tabs-content column-group">
        <h1 class="all-100">Movies Loaned Out</h1>
        
        @foreach($loaned_movies as $loaned_movie)
        <section class="loaned-movie-card all-25 small-100 tiny-100">
            <a href="/movies/{{$loaned_movie->id}}-{{$loaned_movie->url}}">{{$loaned_movie->title}}</a>
            <p><span><strong>Due By:</strong> </span> {{Carbon\Carbon::parse($loaned_movie->pivot->due_at)->format('M-d-Y') }}</p>
            <button class="ink-button green" id="movieReturnTrigger{{$loaned_movie->id}}">Return</button>
            
            <div class="ink-shade fade">
                <div class="ink-modal fade checkout-movie-modal" data-trigger="#movieReturnTrigger{{$loaned_movie->id}}" data-width="800px" data-height="150px" data-close-on-click="true" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
                    <div class="modal-body return-movie-modal-body">
                        <form class="ink-form" method="POST" action="/movies/{{$loaned_movie->id}}/return">                   
                            
                            {{ csrf_field() }}
                            
                            <h2>Return <em>{{$loaned_movie->title}}</em>?</h2>
                            <div style="text-align:right"><input type="submit"  class="ink-button green" value="Return"/></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
    </div>
    <div id="usersMixesTab" class="tabs-content column-group">
        <h1 class="all-100">MovieMixes</h1>
        <p>
        <?php $movie_mixes = Auth::user()->movie_mixes()->get();?>
        @foreach($movie_mixes as $movie_mix) 
        <section class="movie-mix-card all-33 small-100 tiny-100">
            <img src={{$movie_mix->cover}} class="all-25"/>
            <a href="/moviemixes/{{$movie_mix->id}}"><span class="fw-700 all-75">{{$movie_mix->name}}</span></a>
            <p><a href="#" id="modalDeleteMix{{$movie_mix->id}}"> (Delete)</a></p>
            <div class="ink-shade fade">
                <div class="ink-modal fade checkout-movie-modal" data-trigger="#modalDeleteMix{{$movie_mix->id}}" data-width="800px" data-height="150px" data-close-on-click="true" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
                    <div class="modal-body return-movie-modal-body">
                        <form class="ink-form" method="POST" action="/moviemixes/{{$movie_mix->id}}">                   
                            
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            
                            <h2>Delete the moviemix <em>{{$movie_mix->name}}</em>?</h2>
                            <div style="text-align:right"><input type="submit"  class="ink-button green" value="Delete"/></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @endforeach
        </p>
    </div>
</div>

@stop