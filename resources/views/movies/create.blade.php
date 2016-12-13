@extends('layouts.master')
@section("content")

<form id="movieCreateForm" class="ink-form">
	{{ csrf_field() }}
	<div class="column-group horizontal-gutters">
		<div class="column-group all-50">
			<div class="column-group all-100 horizontal-gutters">
				<div class="control-group all-50">
					<label for="name">Movie Title</label>
					<div class="control">
						<input type="text" name="createFormMovieTitle" id="createFormMovieTitle">
					</div>
				</div>
				<div class="control-group all-50">
					<label for="phone">Year Released</label>
					<div class="control">
						<input type="text" name="movie_released" id="createFormMovieReleased">
					</div>
				</div>
			</div>
			<div class="control-group all-50">
				<div class="control " role="search">
					<button class="ink-button green" id="apiMovieSearchButton">Match Movie</button>
				</div>
			</div>
			
			
			<div class="control-group all-100">
				<label for="email">Synopsis</label>
				<div class="control">
					<textarea id="synopsis"></textarea>
				</div>
			</div>
			
			<div class="control-group all-100">
				<label for="email">Director</label>
				<div class="control">
					<input type="text" name="director" id="createFormMovieDirector">
				</div>
				<p class="tip">Separate each name by a comma</p>
			</div>
			
			<div class="control-group all-100">
				<label for="email">Cast</label>
				<div class="control">
					<textarea id="createFormActors"></textarea>
				</div>
				<p class="tip">Separate each name by a comma</p>
			</div>
			
			{{-- Genre Fields --}}
			<fieldset class="control-group all-100 horizontal-gutters">
				<legend>Genres</legend>
				<p class="label">Please select one or more options</p>
				<ul class="control unstyled inline">
					@foreach($genres as $genre)
					<li><input type="checkbox" id="createFormMovieGenre{{$genre->id}}" name="genres[]" value="{{$genre->id}}"><label  class="ink-badge white" for="createFormMovieGenre{{$genre->id}}">{{$genre->name}}</label></li>
					@endforeach
				</ul>
			</fieldset>
		</div>
		<div id="movieFormSearchResults" class="column-group all-40 gutters">
		</div>
	</div>
	
</form>
@stop