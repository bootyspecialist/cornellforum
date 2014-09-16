@extends('layouts.master')
@section('title')
	Create Account
@stop
@section('content')
	<div class="col-md-12">
		<p>An account is required to post on Cornell Forum. <u>All posts are completely anonymous</u> and your email address is <u>never</u> displayed next to posts. When you fill out the form below we'll send a validation link to the email address you entered. After validating your email you can post all you want!</p>
	</div>
	<div class="col-sm-4">
		<h4 class="spacer">Create an account:</h4>
		<form role="form" method="post" action="{{ URL::to('signup') }}" accept-charset="UTF-8">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<fieldset>
		    	<div class="form-group">
		        	<label class="sr-only" for="email">Email:</label>
		        	<input type="text" class="form-control" tabindex="1" placeholder="Your email address (must be verified!)"  name="email" id="email" value="{{ Input::old('email') }}" autofocus>
				</div>
		        <div class="form-group">
		        	<label class="sr-only" for="password">Password:</label>
		        	<input type="password" class="form-control" tabindex="2" placeholder="Choose a password you will remember" name="password" id="password">
				</div>
				<div class="form-group">
		        	<label class="sr-only" for="password">Password:</label>
		        	<input type="password" class="form-control" tabindex="2" placeholder="Type your password again" name="password2" id="password2">
				</div>
				<div class="form-group">
					<img class="captcha-image" src="{{ Captcha::img() }}">
					<input type="captcha" class="form-control captcha-verification" tabindex="2" placeholder="Captcha" name="captcha" id="captcha">
				</div>
				<div class="form-group">
					<button tabindex="3" type="submit" class="btn btn-primary">Send me a verification email</button>
		        </div>
		    </fieldset>
		</form>
	</div>
@stop
