@extends('layouts.master')
@section('title')
	New Thread
@stop
@section('content')
	<div class="col-md-12">
		<h4 class="spacer">Post a new thread:</h4>
	</div>
	{{ Form::open(array('action' => 'ThreadController@newThread')) }}
		<div class="col-md-12 clearfix">
			<div class="form-group">
				<label class="sr-only" for="title">Thread title:</label>
				{{ Form::text('title', null, array('class' => 'form-control input-lg', 'placeholder' => 'Thread title', 'autofocus')) }}
			</div>
		</div>
		<div class="col-md-12 outer-textarea-container">
			<div class="form-group">
				<label class="sr-only" for="body">Thread body:</label>
				{{ Form::textarea('title', null, array('class' => 'form-control with-formatting-buttons', 'rows' => 15, 'placeholder' => 'Compose something interesting here...', 'autofocus')) }}
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
				</ul>
			</div>
		</div>
		<div class="col-md-12">
			{{ Form::submit('Post new thread', array('class' => 'btn btn-primary'))}}
		</div>
	{{ Form::close() }}
@stop
