<!doctype html>
<html>
<head>
	<title>Look at me Login</title>
</head>
<body>

<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
	{!! csrf_field() !!}

	<div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
		<label class="col-md-4 control-label">CPF</label>

		<div class="col-md-6">
			<input type="text" class="form-control" name="login" value="{{ old('login') }}">

			@if ($errors->has('login'))
				<span class="help-block">
                                        <strong>{{ $errors->first('login') }}</strong>
                                    </span>
			@endif
		</div>
	</div>

	<div class="form-group{{ $errors->has('senha') ? ' has-error' : '' }}">
		<label class="col-md-4 control-label">Password</label>

		<div class="col-md-6">
			<input type="password" class="form-control" name="senha">

			@if ($errors->has('senha'))
				<span class="help-block">
                                        <strong>{{ $errors->first('senha') }}</strong>
                                    </span>
			@endif
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> Remember Me
				</label>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-md-6 col-md-offset-4">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-btn fa-sign-in"></i>Login
			</button>

			<a class="btn btn-link" href="{{ url('/senha/reset') }}">Forgot Your Password?</a>
		</div>
	</div>
</form>

</body>
</html>