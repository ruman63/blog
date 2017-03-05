@extends('main')
@section('title', '| Edit Comment')

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2>Edit Comment</h2>
			{!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT' ]) !!}
				{{Form::label('name', 'Name:')}}
				{{Form::text('name', null, ['class' => 'form-control input-sm', 'disabled' => ''])}}

				{{Form::label('email', 'Comment:')}}
				{{Form::text('email', null, ['class' => 'form-control input-sm', 'disabled' => ''])}}

				{{Form::label('comment', 'Comment:')}}
				{{Form::textarea('comment', null, ['class' => 'form-control input-sm', 'rows' => '5'])}}

				{{Form::submit('Save Changes',['class' => 'btn btn-success btn-sm btn-h1-spacing'])}}
			{!! Form::close() !!}
		</div>
	</div>

@endsection