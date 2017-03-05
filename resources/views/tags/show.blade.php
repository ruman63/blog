@extends('main')

@section('title', "| $tag->name - Tag")

@section('content')
	
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $tag->name }} <small>( {{ $tag->posts()->count() }} Posts )</small>	</h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-block btn-h1-spacing">Edit</a>
		</div>
		<div class="col-md-2">
			{!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE']) !!}
				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block btn-h1-spacing' ]) }}
			{!! Form::close() !!}
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>#</th>
					<th>Title</th>
					<th>Tags</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($tag->posts as $post)
					<tr>
						<td>{{ $post->id }}</td>
						<td>{{ $post->title }}</td>
						<td>
							@foreach($post->tags as $ptag)
								<a href="{{ route('tags.show', $ptag->id) }}"<span class="label label-default">{{ $ptag->name }}</span></a>
							@endforeach
						</td>	
						<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a></td>
					</tr>
					@endforeach		
				</tbody>
			</table>
		</div>
	</div>
	
@endsection