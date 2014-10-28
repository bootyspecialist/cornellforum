@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Create Account
@stop
@section('content')
    <div class="col-md-12">
        <h4 class="spacer">Create an account:</h4>
        <p>Creating an account lets you post on Cornell Forum. All posts are <u>anonymous</u> and your account information is never displayed next to them. When you fill out the form below we'll send a verification link to your email address. After validating your email once you can post forever!</p>
    </div>
    <div class="col-sm-5">
        {{ Form::open(array('action' => 'Sentinel\UserController@store')) }}
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <label class="sr-only" for="email">Email:</label>
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email address that you can verify', 'autofocus')) }}
            </div>
            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password you will remember')) }}

            </div>
            <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                {{ Form::password('password_confirmation', array('class' => 'form-control', 'placeholder' => 'Retype your password')) }}
            </div>
            <div class="form-group errors">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
                {{ ($errors->has('password_confirmation') ?  $errors->first('password_confirmation') : '') }}
            </div>
            <div class="form-group">
                <p><strong>Note:</strong> you won't be able to log in until you verify your email!</p>
            </div>
            {{ Form::submit('Create account', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
@stop
