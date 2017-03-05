@extends('main')

@section('title', '| Login')

@section ('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
		<h1>Login</h1>
		<hr>
			{!! Form::open() !!}

				{{Form::label('email', 'Email:')}}
				{{Form::email('email', null, [ 'class' => 'form-control' ])}}

				{{Form::label('password', 'Password:')}}
				{{Form::password('password', [ 'class' => 'form-control' ])}}
				<p><a href="{{ url('password/reset') }}">Forgot Password?</a>

 				<br>
				{{Form::checkbox('remember')}} {{ Form::label('remember','Remember Me') }}
				<br> 
				{{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
			{!! Form::close() !!}
		</div>
	</div>

@endsection