<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<title>Cornell Forum | @yield('title')</title>
    	{{ HTML::style('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css') }}
    	{{ HTML::style('//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') }}
    	{{ HTML::style('http://fonts.googleapis.com/css?family=Lobster|Open+Sans') }}
    	{{ HTML::style('/static/css/cornellforum.css') }}
	</head>
	<body>
		<div id="wrap">
			<div class="navbar navbar-inverse navbar-static-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="/"><img id="shh" src="/static/img/shh.png" height="55"/> Cornell Forum</a>
					</div>
					<div class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li><a href="/search"><i class="fa fa-search"></i> Search</a></li>
							@if (!Sentry::check())
								<li><a href="/login"><i class="fa fa-sign-in"></i> Login</a></li>
								<li><a href="/create-account"><i class="fa fa-user"></i> Create Account</a></li>
							@else
								<li><a href="/thread/new"><i class="fa fa-plus-circle"></i> New Thread</a></li>
							@endif
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li><a href="/frequently-asked-questions"><i class="fa fa-question-circle"></i></a></li>
							@if (Sentry::check())
								<li class="logged-in"><a href="/account"><i class="fa fa-check-square"></i></a></li>
								<li><a title="Log Out" href="/logout"><i class="fa fa-sign-out"></i></a></li>
							@endif
						</ul>
					</div>
				</div>
			</div><!-- /.navbar -->
			<div class="container">
				@yield('content')
			</div><!-- /.container -->
		</div>
		<div id="footer">
			<div class="container">
				<div class="col-md-12">
					<p><i class="fa fa-copyright"></i> Cornell Forum is free as in freedom, <a target="_blank" href="https://github.com/wnajar/cornellforum">open source</a>, and <strong>not</strong> endorsed in any way by Cornell University.</p>
				</div>
			</div>
		</div>
		{{ HTML::script('/static/js/libraries.js') }}
		{{ HTML::script('/static/js/cornellforum.js') }}
	</body>
</html>
