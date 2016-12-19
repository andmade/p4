@extends('layouts.master')
@section("content")

<h2><a href="/admin/movies/create">Add A Movie to The Database</a></h2>
<div class="ink-grid">
    <div class="column-group">
        <div class="all-100 large-25">
            @foreach($movies as $movie)
            <section class="movies">
                <ul>
                    <li><a href="movies/{{$movie->id}}-{{$movie->url}}">{{$movie->title}}</a><a href="movies/{{$movie->id}}-{{$movie->url}}/edit"> (Edit)</a><a href="#" id="modalDeleteMovie{{$movie->id}}"> (Delete)</a></li>
                    <div class="ink-shade fade">
                        <div class="ink-modal fade delete-movie-modal" data-trigger="#modalDeleteMovie{{$movie->id}}" data-width="800px" data-height="150px" data-close-on-click="true" role="dialog" aria-hidden="true" aria-labelled-by="modal-title">
                            <div class="modal-body delete-movie-modal-body">
                                <form class="ink-form" method="POST" action="/admin/movies/{{$movie->id.'-'.$movie->url}}">
                                    
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