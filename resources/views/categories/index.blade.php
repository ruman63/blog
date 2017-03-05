@extends('main')
@section('title', '| Post Categories')

@section('content')


	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1 class="text-center">Post Categories</h1>
			<br>
			{!! Form::open(['url' => route('categories.store')]) !!}
				<div class="form-group row">
					<div class="col-md-10">{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Add Category'])}}</div>
					<div class="col-md-2">{{ Form::submit('Add', ['class' => 'btn btn-success btn-block'])}}</div>
				</div>
			{!! Form::close() !!}
			<br>
			<table class="table">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th></th>
				</thead>
				<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{$category->id}}</td>
						<td>{{$category->name}}</td>
						<td><div class="row">
							<div class="col-md-2 col-md-offset-8">{!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'DELETE']) !!}
						{{ Form::submit('Delete', ['class' => 'btn btn-danger' ]) }}
					{!! Form::close() !!}</div></div></td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>		
	</div><!--end of row-->
@endsection