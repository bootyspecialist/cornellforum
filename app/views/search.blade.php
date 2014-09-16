@extends('layouts.master')
@section('title')
	Search
@stop
@section('content')
	<form role="form" action="/search" method="get">
		<div class="form-group">
			<label for="search-term" class="sr-only">Search term:</label>
    		<input type="text" class="form-control input-lg" id="search-term" placeholder="Search for something interesting...">
		</div>
	</form>
	<div id="search-results">
		<p class="text-muted">Results will populate here as you search...</p>
	</div>
@stop
