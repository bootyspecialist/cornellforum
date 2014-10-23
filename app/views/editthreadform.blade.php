<div id="edit-thread-form">
	{{ Form::open(array('url' => '/edit/thread/' . $thread->id)) }}
		<div id="edit-thread-{{ $thread->id }}" class="thread-intro">
			<input class="thread-title form-control input-lg" value="{{{ $thread->title }}}"/>
			<h4 class="thread-subtitle">{{{ $thread->points }}} {{{ Lang::choice('point|points', $thread->points) }}},  {{{ $thread->comments()->count() }}} {{{ Lang::choice('comment|comments', $thread->comments()->count()) }}}, posted {{{ $thread->created_at->diffForHumans() }}}</h4>
			<div class="thread-content">
					<div class="thread-actions">
					@if(Sentry::check())
						@if(Vote::where('user_id', '=', Sentry::getUser()->id)->where('thread_id', '=', $thread->id)->where('sign', '=', 1)->exists())
							<a class="btn btn-xs btn-info" href="#">Voted Up</a>
						@else
							<a class="btn btn-xs btn-default" href="/vote/{{{ $thread->id }}}/up">Vote Up</a>
						@endif
						@if(Vote::where('user_id', '=', Sentry::getUser()->id)->where('thread_id', '=', $thread->id)->where('sign', '=', -1)->exists())
							<a class="btn btn-xs btn-danger" href="#">Voted Down</a>
						@else
							<a class="btn btn-xs btn-default{{ (Sentry::getUser()->created_at->diff(\Carbon\Carbon::now())->days >= 30 ? '' : ' disabled') }}" href="/vote/{{{ $thread->id }}}/down">Vote Down</a>
						@endif
						<span class="quote-this-thread btn btn-xs btn-default" data-thread-id="{{ $thread->id }}">Quote</span>
						@if(Sentry::getUser()->id == $thread->user_id)
							<a href="/delete/thread/{{ $thread->id }}" class="btn btn-xs btn-default needs-confirmation">Delete</a>
						@endif
					@endif
				</div>
				<div class="outer-textarea-container">
					<div class="form-group">
						<label class="sr-only" for="body">Thread body:</label>
						<textarea class="form-control" rows="8" name="body" cols="50">{{ $thread->body_raw }}</textarea>
					</div>
				</div>
				<div class="form-group">
					{{ Form::submit('Post edited thread', array('class' => 'btn btn-warning btn-sm')) }}
					<span class="btn btn-default btn-sm dont-edit-this-thread" data-thread-id="{{ $thread->id }}">Don't edit and go back</span>
				</div>
			</div>
		</div>
	{{ Form::close() }}
</div>
