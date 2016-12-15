@extends('layouts.master')
@section("content")

<div class="ink-grid horizontal-gutters">
	<div class="column-group all-60 align-center push-center">
		<h2 class="landing-title all-100">Welcome!</h2>
		<h5 class="all-100">This is the online catalog of movies available from the <em>andmade</em> movie club. 
		Browse our library, peruse users shared movie mixes, and log in to reserve a title for pickup.</h5>
	</div>
	
	
	<div class="column-group all-100">
		<h2 class="all-100">Recently Added</h2>
		<p class="all-100">(row of recently added movies goes here)</p>
	</div>

	<div class="column-group all-100">
		<h2 class="all-100">Latest Movie Mixes</h2>
		<p class="all-100">(row of recently added mix goes here)</p>
	</div>
</div>


@stop