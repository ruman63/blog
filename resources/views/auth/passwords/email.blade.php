@extends('main')
@section('title', '| Forgot Password')

@section('content')

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Forgot Password</div>
				<div class="panel-body">
					{!! Form::open(['url' => 'password/email', 'method' => 'POST']) !!}
						{{ Form::label('email', 'Email:')}}
						{{ Form::email('email', null, ['class' => 'form-control'])}}
						{{ Form::submit('Send Confirmation Link', ['class' => 'btn btn-primary btn-h1-spacing'])}}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	
	
	

@endsection