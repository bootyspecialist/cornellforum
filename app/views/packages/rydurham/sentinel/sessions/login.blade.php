@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Login
@stop
@section('content')
    <div class="col-md-12">
        <h4 class="spacer">Login:</h4>
        <p>Logging in allows you to post new threads and make comments anonymously. No captchas, no bull!</p>
    </div>
    <div class="col-sm-4">
        {{ Form::open(array('action' => 'Sentinel\SessionController@store')) }}
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                <label class="sr-only" for="email">Email:</label>
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Email', 'autofocus')) }}
            </div>
            <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Password'))}}
            </div>
            <div class="form-group hide">
                <div class="checkbox">
                    <label>
                        <input name="rememberMe" type="checkbox" value="rememberMe" checked>
                        Remember me?
                    </label>
                </div>
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
