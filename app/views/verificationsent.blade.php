@extends(Config::get('Sentinel::config.layout'))
@section('title')
    Verification Email Sent!
@stop
@section('content')
    <div class="col-md-12">
        <h4 class="spacer">Verification email sent!</h4>
        <p>A verification email has been sent to the email address you specified and should appear in your email inbox shortly. Click the link in this email to activate your account and log in for the first time. Thanks for taking the time to create an account!</p>
        <p>Haven't received your verification email yet? <a href="/resend">Let's re-send it.</a>
    </div>
@stop
