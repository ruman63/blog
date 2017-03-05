@extends('main')
@section('title', '| Delete Comment?')

@section('content')
	
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="well">
				<h3>Are you sure you want to delete this comment?</h3>
				<h5><strong>{{ $comment->name }}</strong> <small>{{ $comment->email }}</small></h5>
				<p>
					{{ $comment->comment }}
				</p>
				<div class="row">
				{!! Form::open(['route' => ['comments.destroy', $comment->id], 'method' => 'DELETE']) !!}
					<div class="form-spacing-top pull-right">
						<input type="submit" value="Delete Comment" class="btn btn-danger">
						<a href="{{ route('posts.show', $comment->post_id) }}" class="btn btn-default">Cancel</a>
					</div>
				{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

@endsection