@extends('layouts.master')
@section("content")

<div class="ink-grid ink-flex">
	<div class="column-group">
		<h1 class="all-100">Recommend A Movie</h1>
		<p>Want a movie that we don't have? Let us know which in the form below!</p>
		<form class="ink-form all-100" method="POST" action="/account/recommend">
			
			{{ csrf_field() }}
			
			<div class="column-group xlarge-50 large-50 medium-100 small-100 tiny-100 horizontal-gutters">
				
				{{-- Movie Title and Year --}}
				
				<div class="control-group all-100 required">
					<label for="detailFormMovieTitle">Movie Title</label>
					<div class="control">
						<input id="detailFormMovieTitle" name="movie_title" type="text" value="{{ old("movie_title") ? old("movie_title") : ""}}"/>
					</div>
					@if($errors->get('movie_title'))
					@foreach($errors->get('movie_title') as $error)
					<p class="error-message tip">{{ $error }}</p>
					@endforeach
					@endif
				</div>
				<div class="control-group all-100 required">
					<label for="detailFormMovieReleased">
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
			</div>
			<div class="control-group all-50">
				<div class="all-100">
					<input type="submit"  class="ink-button green" value="Recommend Movie"/>
				</div>
			</div>			
		</div>
	</form>
</div>


@stop