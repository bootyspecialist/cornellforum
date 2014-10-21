<div id="edit-comment-form">
	{{ Form::open(array('url' => '/edit/comment/' . $comment->id)) }}
		<div class="outer-textarea-container">
			<div class="form-group">
				<label class="sr-only" for="body">Comment body:</label>
				<textarea class="form-control" rows="6" name="body" cols="50">{{ $comment->body_raw }}</textarea>
			</div>
		</div>
		<div class="form-group">
			{{ Form::submit('Post edited comment', array('class' => 'btn btn-warning btn-sm')) }}
			<span class="btn btn-default btn-sm">Don't save and go back</span>
		</div>
	{{ Form::close() }}
</div>
