<div id="edit-thread-form">
	{{ Form::open(array('url' => '/edit/thread/' . $thread->id)) }}
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
	{{ Form::close() }}
</div>
