@extends('layouts.master')
@section('title')
	Home
@stop
@section('content')
	<div class="col-md-12">
		@foreach ($threads as $thread)
			<div class="thread-preview clearfix" id="thread-{{{ $thread->id }}}">
				<div class="thread-index-content">
					<h2 class="thread-index-title">
						<a href="/thread/{{{ $thread->id }}}/{{{ $thread->slug }}}">{{{ $thread->title }}}</a>
						@if(Sentry::check() && !Threadview::where('user_id', '=', Sentry::getUser()->id)->where('thread_id', '=', $thread->id)->exists() && $thread->updated_at->diff(\Carbon\Carbon::now())->days <= 7)
							<span class="new-thread-notification text-primary">new!</span>
						@elseif(Sentry::check() && Threadview::where('user_id', '=', Sentry::getUser()->id)->where('thread_id', '=', $thread->id)->where('updated_at', '<', $thread->updated_at)->exists() && $thread->updated_at->diff(\Carbon\Carbon::now())->days <= 7)
							<span class="new-comment-notification text-muted">new comments!</span>
						@endif
					</h3>
					<p class="thread-index-subtitle">{{{ $thread->points }}} {{{ Lang::choice('point|points', $thread->points) }}}, {{{ $thread->comments()->count() }}} {{{ Lang::choice('comment|comments', $thread->comments()->count()) }}}, posted {{{ $thread->created_at->diffForHumans() }}}</p>
				</div>
			</div>
		@endforeach
	</div>
	<div class="col-xs-12">
		<div id="pagination">
			{{ $threads->links() }}
		</div>
	</div>
@stop
