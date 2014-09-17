@extends('layouts.master')
@section('title')
	Thread {{{ $thread->id }}} - {{{ $thread->title }}}
@stop
@section('content')
	<div class="col-md-12">
		<div id="thread-intro">
			<h3 class="thread-title">{{{ $thread->title }}}</h3>
			<h4 class="thread-subtitle">{{{ $thread->points }}} {{{ Lang::choice('point|points', $thread->points) }}}, x comments, posted {{{ $thread->created_at->diffForHumans() }}}</h4>
			<p class="thread-body">{{ $thread->body }}</p>
			<a href="/"><i class="fa fa-angle-double-left"></i> Back to homepage</a>
		</div>
		<div id="comments">

		</div>
		<div id="reply-area">
			<h5 class="comments-header">Comment on this thread:</h5>
			@if(Sentry::check())
				<div id="new-comment-form">
					{{ Form::open(array('action' => 'CommentController@newComment')) }}
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
					<form role="form">
						<textarea class="textarea form-control" cols="40" id="id_body" name="body" placeholder="Whoops! You need to log in or create an account to do this..." disabled rows="4"></textarea>
					</form>
				</div>
				<p class="need-to-login"><a class="btn btn-primary" href="/account/login"><i class="fa fa-sign-in"></i> Login</a> or <a class="btn btn-primary" href="/account/signup"><i class="fa fa-user"></i> create an account</a> to post a comment on this thread. Creating an account is quick and easy, we promise! <i class="fa fa-smile-o"></i></p>
			@endif
		</div>
	</div>
@stop
