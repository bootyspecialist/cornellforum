@extends('layouts.master')
@section('title')
	Home
@stop
@section('content')
	<div class="col-md-12">
		@foreach ($threads as $thread)
			<div class="thread-preview clearfix" id="thread-{{{ $thread->id }}}">
				<!-- <div class="vote-arrow">
					<i class="fa fa-angle-right"></i>
				</div> -->
				<div class="thread-index-content">
					<h2 class="thread-index-title"><a href="/thread/{{{ $thread->id }}}/{{{ $thread->slug }}}">{{{ $thread->title }}}</a></h3>
					<p class="thread-index-subtitle">{{{ $thread->points }}} {{{ Lang::choice('point|points', $thread->points) }}}, {{{ $thread->comments()->count() }}} {{{ Lang::choice('comment|comments', $thread->comments()->count()) }}}, posted {{{ $thread->created_at->diffForHumans() }}}</p>
				</div>
			</div>
		@endforeach
	</div>
	<div class="col-xs-12">
		<div id="pagination">

		</div>
	</div>
@stop
