@extends('layouts.master')
@section('title')
	Login
@stop
@section('content')
	<div class="col-md-12">
		<p>Authenticating with your email address allows you to post new threads and make comments. Remember that <u>all posts are still completely anonymous</u>.</p>
	</div>
	<div class="col-sm-4">
		<h4 class="spacer">Login:</h4>
		<form role="form" method="post" action="{{ URL::to('login') }}" accept-charset="UTF-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<fieldset>
		    	<div class="form-group">
		        	<label class="sr-only" for="email">Email:</label>
		        	<input type="text" class="form-control" tabindex="1" placeholder="abc123@cornell.edu"  name="email" id="email" value="{{ Input::old('email') }}" autofocus>
				</div>
		        <div class="form-group">
		        	<label class="sr-only" for="password">Password:</label>
		        	<input type="password" class="form-control" tabindex="2" placeholder="Password" name="password" id="password">
				</div>
				<div class="form-group">
					<button tabindex="3" type="submit" class="btn btn-primary">Login</button>
		        </div>
		    </fieldset>
		</form>
	</div>
@stop
