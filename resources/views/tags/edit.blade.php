@extends('main')
@section('title', "| Edit Tag - $tag->name")

@section('content')

	<div class="row">
		<div class="col-md-">
			<h1>Edit Tag - {{ $tag->name }}</h1>
			{!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}
				{{ Form::label('name', 'Name:') }}
				{{ Form::text('name', null, ['class' => 'form-control']) }}
				{{ Form::submit('Save Changes',['class' => 'btn btn-success btn-h1-spacing']) }}
			{!! Form::close() !!}
		</div>
	</div>
	
@endsection