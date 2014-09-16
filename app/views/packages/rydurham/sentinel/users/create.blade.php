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
        {{ Form::open(array('action' => 'Sentinel\UserController@store')) }}
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <label class="sr-only" for="email">Email:</label>
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Your email address (must be verified!)')) }}
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password you will remember')) }}
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
            <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Retype your password')) }}
                {{ ($errors->has('password_confirmation') ?  $errors->first('password_confirmation') : '') }}
            </div>
            {{ Form::submit('Send verification email', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
@stop
