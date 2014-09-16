@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Resend Verification Email
@stop
@section('content')
    <div class="col-sm-3">
        <h4 class="spacer">Resend verification email:</h4>
        {{ Form::open(array('action' => 'Sentinel\UserController@resend', 'method' => 'post')) }}
            <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                {{ Form::text('email', null, array('class' => 'form-control', 'placeholder' => 'Your email address', 'autofocus')) }}
            </div>
            <div class="form-group errors">
                {{ ($errors->has('email') ? $errors->first('email') : '') }}
            </div>
            {{ Form::submit('Resend email', array('class' => 'btn btn-primary')) }}
        {{ Form::close() }}
    </div>
@stop
