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
                    <li><a href="movies/{{$movie->url}}-{{$movie->id}}">{{$movie->title}}</a><a href="movies/{{$movie->url}}-{{$movie->id}}/edit"> (Edit)</a><a href="#" id="modalDeleteMovie{{$movie->id}}"> (Delete)</a></li>
                    <div class="ink-shade fade">
                        <div class="ink-modal fade delete-movie-modal" data-trigger="#modalDeleteMovie{{$movie->id}}" data-width="800px" data-height="150px" data-close-on-click="true" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
                            <div class="modal-body delete-movie-modal-body">
                                <form class="ink-form" method="POST" action="/admin/movies/{{$movie->url.'-'.$movie->id}}">
                                    
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}

                                    <h2>Delete <em>{{$movie->title}}</em>?</h2>
                                    <div style="text-align:right"><input type="submit"  class="ink-button red" id="detailFormMovieSubmitButton" value="Delete Movie"/></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </ul>
            </section>
            @endforeach
        </div>
    </div>
</div>
@stop