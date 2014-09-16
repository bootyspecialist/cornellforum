@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Create Account
@stop
@section('content')
    <div class="col-md-12">
        <p>An account is required to post on Cornell Forum. <u>All posts are completely anonymous</u> and your email address is <u>never</u> displayed next to posts. When you fill out the form below we'll send a validation link to the email address you entered. After validating your email you can post all you want!</p>
    </div>
    <div class="col-sm-5">
        <h4 class="spacer">Create an account:</h4>
        {{ Form::open(array('action' => 'Sentinel\UserController@store')) }}
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <label class="sr-only" for="email">Email:</label>
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email address (must be verified!)', 'autofocus')) }}
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
            {{ Form::submit('Send verification email', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
@stop
