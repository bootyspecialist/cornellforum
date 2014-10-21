<div id="edit-comment-form">
	{{ Form::open(array('url' => '/edit/comment/' . $comment->id)) }}
		<div class="outer-textarea-container">
			<div class="form-group">
				<label class="sr-only" for="body">Comment body:</label>
				<textarea class="form-control with-formatting-buttons" rows="12" name="body" cols="50">{{ $comment->body_raw }}</textarea>
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
			{{ Form::submit('Post edited comment', array('class' => 'btn btn-primary')) }}
		</div>
	{{ Form::close() }}
</div>
