@extends('layouts.master')
@section('title')
	 {{{ $thread->title }}} (#{{{ $thread->id }}})
@stop
@section('content')
	<div class="col-md-12">
		<div id="thread-intro">
			<h3 class="thread-title">{{{ $thread->title }}}</h3>
			<h4 class="thread-subtitle">{{{ $thread->points }}} {{{ Lang::choice('point|points', $thread->points) }}},  {{{ $thread->comments()->count() }}} {{{ Lang::choice('comment|comments', $thread->comments()->count()) }}}, posted {{{ $thread->created_at->diffForHumans() }}}</h4>
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
			<div class="post-body">{{ $thread->body }}</div>
		</div>
		@if (count($comments) > 0)
			<div id="comments">
				@foreach($comments as $comment)
					<div class="comment{{ ($comment->user_id == $thread->user_id ? ' comment-op' : '') }}" id="comment-{{{ $comment->id }}}">
						<div class="comment-user-frame">
							<i class="fa fa-user anonymous-user-icon"></i>
						</div>
						<div class="comment-content">
							<div class="comment-main">
								<div class="post-body">{{ $comment->body }}</div>
							</div>
							<div class="comment-secondary">
								<p class="comment-time">{{{ $comment->created_at->diffForHumans() }}}</p>
								<div class="comment-actions">
									@if (Sentry::check())
										<span class="quote-this-comment comment-action" data-comment-id="{{ $comment->id }}"><i class="fa fa-quote-left"></i></span>
									@endif
									@if(Sentry::check() && Sentry::getUser()->id == $comment->user_id)
										<a href="/delete/comment/{{ $comment->id }}" class="delete-comment-button comment-action needs-confirmation"><i class="fa fa-trash"></i></a>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="separator"></div>
				@endforeach
			</div>
		@endif
		<div id="reply-area">
			<h5 class="new-comment-header">Comment on this thread:</h5>
			@if(Sentry::check())
				<div id="new-comment-form">
					{{ Form::open(array('url' => '/comment/' . $thread->id . '/new')) }}
						<div class="outer-textarea-container">
							<div class="form-group">
								<label class="sr-only" for="body">Thread body:</label>
								{{ Form::textarea('body', null, array('class' => 'form-control with-formatting-buttons', 'rows' => 12, 'placeholder' => 'Compose something interesting here...')) }}
							</div>
							<div class="formatting-buttons">
								<ul>
									<li title="insert bolded text" class="formatting-button bold" data-action="bold">
										<i class="fa fa-bold"></i>
									</li>
									<li title="insert italicized text" class="formatting-button italic" data-action="italic">
										<i class="fa fa-italic"></i>
									</li>
									<li title="insert an image" class="formatting-button image" data-action="image">
										<i class="fa fa-picture-o"></i>
									</li>
									<li title="insert a youtube video" class="formatting-button youtube" data-action="youtube">
										<i class="fa fa-youtube"></i>
									</li>
									<li title="insert a quote" class="formatting-button quote" data-action="quote">
										<i class="fa fa-quote-left"></i>
									</li>
									<li title="help" class="formatting-help">
										<a target="_blank" href="/frequently-asked-questions"><i class="fa fa-question-circle"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="form-group errors">
							{{ ($errors->has('body') ?  $errors->first('body') : '') }}
						</div>
						<div class="form-group">
							{{ Form::submit('Post comment', array('class' => 'btn btn-primary'))}}
							<div class="checkbox checkbox-inline btn btn-sm btn-default no-bump">
								<label>
							    	{{ Form::checkbox('no_bump', 'yes') }}
							    	Don't Bump
							  	</label>
							</div>
						</div>
					{{ Form::close() }}
				</div>
			@else
				<div id="new-comment-form">
					<div class="outer-textarea-container">
						<div class="form-group">
							<label class="sr-only" for="body">Thread body:</label>
							{{ Form::textarea('body', null, array('class' => 'form-control with-formatting-buttons', 'rows' => 12, 'placeholder' => 'Whoops! You need to log in or create an account to comment on this thread...', 'disabled')) }}
						</div>
						<div class="formatting-buttons">
							<ul>
								<li title="insert bolded text" class="formatting-button bold" data-action="bold">
									<i class="fa fa-bold"></i>
								</li>
								<li title="insert italicized text" class="formatting-button italic" data-action="italic">
									<i class="fa fa-italic"></i>
								</li>
								<li title="insert an image" class="formatting-button image" data-action="image">
									<i class="fa fa-picture-o"></i>
								</li>
								<li title="insert a youtube video" class="formatting-button youtube" data-action="youtube">
									<i class="fa fa-youtube"></i>
								</li>
								<li title="insert a quote" class="formatting-button quote" data-action="quote">
									<i class="fa fa-quote-left"></i>
								</li>
								<li title="help" class="formatting-help">
									<a target="_blank" href="/frequently-asked-questions"><i class="fa fa-question-circle"></i></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="form-group">
						<p class="need-to-login"><a class="btn btn-primary" href="/login"><i class="fa fa-sign-in"></i> Login</a> <a class="btn btn-primary" href="/create-account"><i class="fa fa-user"></i> Create an account</a> Creating an account is quick and easy, we promise!</p>
					</div>
				</div>
			@endif
		</div>
	</div>
@stop
