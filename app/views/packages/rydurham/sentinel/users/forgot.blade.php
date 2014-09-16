@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Forgot Password
@stop
@section('content')
    <div class="col-sm-3">
        <h4 class="spacer">Forgot your password?</h4>
        {{ Form::open(array('action' => 'Sentinel\UserController@forgot', 'method' => 'post')) }}
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Enter your email address', 'autofocus')) }}
            </div>
            <div class="form-group errors">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
            {{ Form::submit('Send reset instructions', array('class' => 'btn btn-primary'))}}
        {{ Form::close() }}
    </div>
@stop
