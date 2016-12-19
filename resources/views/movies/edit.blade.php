@extends('layouts.master')
@section("content")

{{-- Form --}}
<form class="ink-form" id="movieDetailForm" method="POST" action="/admin/movies/{{$retrieved_movie->id.'-'.$retrieved_movie->url}}">
	
	{{ method_field('PUT') }}
	{{ csrf_field() }}
	
	<div class="column-group horizontal-gutters">
		<div class="column-group all-50 small-100 tiny-100 horizontal-gutters">
			
			{{-- Movie Title and Year --}}
			<div class="column-group all-100 horizontal-gutters">
				<div class="control-group all-50 required">
					<label for="name">Movie Title</label>
					<div class="control">
						<input id="detailFormMovieTitle" name="movie_title" type="text" value="{{ old("movie_title") ? old("movie_title") : $retrieved_movie->title}}" />
					</div>
					@if($errors->get('movie_title'))
					@foreach($errors->get('movie_title') as $error)
					<p class="error-message tip">{{ $error }}</p>
					@endforeach
					@endif
				</div>
				<div class="control-group all-50 required">
					<label for="phone">
						Year Released
					</label>
					<div class="control">
						<input id="detailFormMovieReleased" name="movie_released" type="text" value="{{ old("movie_released") ? old("movie_released") : $retrieved_movie->released}}" />
					</div>
					@if($errors->get('movie_released'))
					@foreach($errors->get('movie_released') as $error)
					<p class="error-message tip">{{ $error }}</p>
					@endforeach
					@endif
				</div>
			</div>
			
			{{-- Synopsis --}}
			<div class="control-group all-100 required">
				<label for="email">
					Synopsis
				</label>
				<div class="control">
					<textarea name="movie_synopsis" id="detailFormMovieSynopsis">{{ old("movie_synopsis") ? old("movie_synopsis") : $retrieved_movie->synopsis}}</textarea>
				</div>
			</div>
			
			{{-- Director --}}
			<div class="control-group all-100 required">
				<label for="detailFormMovieDirector">
					Director
				</label>
				<div class="control">
					<input id="detailFormMovieDirector" name="movie_director" type="text" value="{{ old("movie_director") ? old("movie_director") : $retrieved_movie->directors->implode('name', ',')}}"/>
				</div>
				<p class="tip">
					Separate each name by a comma
				</p>
				@if($errors->get('movie_director'))
				@foreach($errors->get('movie_director') as $error)
				<p class="error-message tip">{{ $error }}</p>
				@endforeach
				@endif
			</div>
			
			{{-- Actors/Cast --}}
			<div class="control-group all-100 required">
				<label for="detailFormMovieActors">
					Cast
				</label>
				<div class="control">
					<textarea name="movie_actors" id="detailFormMovieActors">{{ old("movie_actors") ? old("movie_actors") : $retrieved_movie->actors->implode('name', ',')}}</textarea>
				</div>
				<p class="tip">
					Separate each name by a comma
				</p>
				@if($errors->get('movie_actors'))
				@foreach($errors->get('movie_actors') as $error)
				<p class="error-message tip">{{ $error }}</p>
				@endforeach
				@endif
			</div>
		</div>
		
		{{-- Genre Checkboxes --}}
		<div class="column-group all-50 small-100 tiny-100  horizontal-gutters">
			<fieldset class="control-group all-100 horizontal-gutters required">
				<legend>
					Genres
				</legend>
				<p class="label">
					Please select one or more options
				</p>
				@if($errors->get('movie_genres'))
				@foreach($errors->get('movie_genres') as $error)
				<p class="error-message tip">{{ $error }}</p>
				@endforeach
				@endif
				<ul class="control unstyled inline">
					<?php $retrieved_genres = $retrieved_movie->genres()->pluck('name');?>
					@foreach($genres as $genre)
					<li>
						<input id="detailFormMovieGenre{{$genre->id}}" name="movie_genres[]" type="checkbox" value="{{$genre->id}}"
						
						@if($retrieved_genres->contains($genre->name))
						checked="checked"
						@endif
						/>
						<label for="detailFormMovieGenre{{$genre->id}}">{{$genre->name}}</label>
					</li>
					@endforeach
				</ul>
			</fieldset>
			<div class="control-group all-50">
				<div class="control" role="search">
					<input type="submit"  class="ink-button blue" id="detailFormMovieSubmitButton" value="Update Movie"/>
				</div>
			</div>
		</div>
	</div>
</form>
@stop