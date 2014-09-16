@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Verification Email Sent!
@stop
@section('content')
    <div class="col-md-12">
        <h4 class="spacer">Verification email sent!</h4>
        <p>A verification email has been sent to the email address you specified. Click the link in this email to activate your account and log in. Once you log in you'll be able to post and comment as much as you want.</p>
        <a class="btn btn-default" href="/">Return to homepage</a>
    </div>
@stop
