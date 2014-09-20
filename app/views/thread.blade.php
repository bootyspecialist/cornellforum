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
				<a class="btn btn-xs btn-default{{ (Sentry::check() ? '' : ' disabled') }}" href="/vote/{{{ $thread->id }}}/up"><i class="fa fa-angle-up"></i> Vote Up</a>
				<a class="btn btn-xs btn-default{{ (Sentry::check() && Sentry::getUser()->created_at->diff(\Carbon\Carbon::now())->days >= 30 ? '' : ' disabled') }}" href="/vote/{{{ $thread->id }}}/down"><i class="fa fa-angle-down"></i> Vote Down</a>
			</div>
			<p class="post-body">{{ $thread->body }}</p>
		</div>
		@if (count($comments) > 0)
			<div id="comments">
				@foreach($comments as $comment)
					<div class="comment{{ ($comment->user_id == $thread->user_id ? ' comment-op' : '') }}" id="comment-{{{ $comment->id }}}">
						<p class="comment-body">{{ $comment->body }}</p>
						<p class="comment-time">{{{ $comment->created_at->diffForHumans() }}} {{ ($comment->user_id == $thread->user_id ? 'by OP' : '') }}</p>
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
						<p class="need-to-login"><a class="btn btn-primary" href="/login"><i class="fa fa-sign-in"></i> Login</a> or <a class="btn btn-primary" href="/create-account"><i class="fa fa-user"></i> Create an account</a> to post a comment on this thread. Creating an account is quick and easy, we promise! <i class="fa fa-smile-o"></i></p>
					</div>
				</div>
			@endif
		</div>
	</div>
@stop
