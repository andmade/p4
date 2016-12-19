@extends('layouts.master')
@section("content")

{{-- Flash Session --}}
@if(Session::has('message'))
<div class="alert alert-info">
	<a class="close" data-dismiss="alert">×</a>
	<h1><strong>Heads Up!</strong> {!!Session::get('message')!!}</h1>
</div>
@endif

{{-- Form --}}
<form class="ink-form" id="movieDetailForm" method="POST" action="/admin/movies">
	{{ csrf_field() }}
	<div class="column-group horizontal-gutters">
		<div class="column-group xlarge-50 large-50 medium-100 small-100 tiny-100 horizontal-gutters">
			
			{{-- Movie Title and Year --}}
			<div class="column-group all-100 horizontal-gutters">
				<div class="control-group all-50 required">
					<label for="name">Movie Title</label>
					<div class="control">
						<input id="detailFormMovieTitle" name="movie_title" type="text" value="{{ old("movie_title") ? old("movie_title") : ""}}"/>
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
						<input id="detailFormMovieReleased" name="movie_released" type="text"/>
					</div>
					@if($errors->get('movie_released'))
					@foreach($errors->get('movie_released') as $error)
					<p class="error-message tip">{{ $error }}</p>
					@endforeach
					@endif
				</div>
				<div class="control-group all-100">
					<p class="tip" id="detailFormSearchTip">
						Enter part of the title and the year of the movie you're searching for and click Match Movie. We'll attempt to find and pre-fill the information for the movie.
					</p>
				</div>
				<div class="control-group all-100">
					<p class="tip" id="detailFormSearchMessage" style="display:none">
						Status Message Goes Here
					</p>
				</div>
			</div>
			<div class="control-group all-50">
				<div class="control " role="search">
					<button class="ink-button orange" id="apiMovieSearchButton">
					Match Movie
					</button>
				</div>
			</div>
			
			{{-- Synopsis --}}
			<div class="control-group all-100 required">
				<label for="email">
					Synopsis
				</label>
				<div class="control">
					<textarea name="movie_synopsis" id="detailFormMovieSynopsis"></textarea>
				</div>
			</div>
			
			{{-- Director --}}
			<div class="control-group all-100 required">
				<label for="detailFormMovieDirector">
					Director
				</label>
				<div class="control">
					<input id="detailFormMovieDirector" name="movie_director" type="text" />
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
					<textarea name="movie_actors" id="detailFormMovieActors"></textarea>
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
					@foreach($genres as $genre)
					<li>
						<input id="detailFormMovieGenre{{$genre->id}}" name="movie_genres[]" type="checkbox" value="{{$genre->id}}"/>
						<label class="ink-badge orange" for="detailFormMovieGenre{{$genre->id}}">{{$genre->name}}</label>
					</li>
					@endforeach
				</ul>
			</fieldset>
			<div class="control-group all-50">
				<div class="control " role="search">
					<input type="submit"  class="ink-button blue" id="detailFormMovieSubmitButton" value="Add to Movies Database"/>
				</div>
			</div>
		</div>
	</div>
</form>
@stop