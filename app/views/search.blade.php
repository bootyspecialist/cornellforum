@extends('layouts.master')
@section('title')
	Search
@stop
@section('content')
	<div class="col-md-12">
		<h4 class="spacer">Search for something interesting:</h4>
		<form role="form" action="/search" method="get">
			<div class="form-group">
				<label for="search-term" class="sr-only">Search term:</label>
	    		<input type="text" class="form-control input-lg" id="search-term" placeholder="jeff seid flexing shirtless tight briefs no homo">
			</div>
		</form>
		<div id="search-results">
			<p class="text-muted">Results will populate here as you search...</p>
		</div>
	</div>
@stop
