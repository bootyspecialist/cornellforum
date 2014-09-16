@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Login
@stop
@section('content')
    <div class="col-md-12">
        <p>Authenticating with your email address allows you to post new threads and make comments. Remember that <u>all posts are still completely anonymous</u>.</p>
    </div>
    <div class="col-sm-3">
        <h4 class="spacer">Login:</h4>
        {{ Form::open(array('action' => 'Sentinel\SessionController@store')) }}
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <label class="sr-only" for="email">Email:</label>
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'abc123@cornell.edu', 'autofocus')) }}
            </div>
            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
            </div>
            <div class="form-group errors">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
                {{ ($errors->has('password') ?  $errors->first('password') : '') }}
            </div>
            {{ Form::submit('Login', array('class' => 'btn btn-primary'))}}
            <a class="btn btn-link" href="{{ route('Sentinel\forgotPasswordForm') }}">Forgot password?</a>
        {{ Form::close() }}
    </div>
</div>
@stop
