@extends('main')

@section('title', "| $post->title")

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			<p class="lead">{!! $post->body !!}</p>
			<hr>
			<div class="tags">
				@foreach($post->tags as $tag)
					<a href="{{ route('tags.show',$tag->id) }}"><span class="label label-default">{{ $tag->name }}</span></a>
				@endforeach
			</div>	
			<div id="backend-comments">
				<h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>
				<table class="table">
					<thead>
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Comment</th>
							<th width="70px"></th>
						</tr>
					</thead>
					<tbody>
						@foreach($post->comments as $comment)
							<tr>
								<td>{{ $comment->name }}</td>
								<td>{{ $comment->email }}</td>
								<td>{{ substr($comment->comment, 0, 40) }}{{ strlen($comment->comment) > 40 ? "..." : ""}}</td>
								<td>
									<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
									<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
									
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<label>Url:</label>
					<p><a href="{{ route('blog.single', $post->slug) }}">{{ route('blog.single', $post->slug) }}</a></p>
				  </dl>
				<dl class="dl-horizontal">
					<label>Created At:</label>
					<p>{{ date('M j, Y h:i A',strtotime($post->created_at)) }}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Last Modified:</label>
					<p>{{ date('M j, Y h:i A',strtotime($post->updated_at)) }}</p>
				</dl>
				<dl>
			        <label>Category:</label>
			        <p>
			        @if(!is_null($post->category_id))
			        	{{ $post->category->name }}
			        @else
			        	none
			        @endif
			        </p>

			    </dl>
				<hr>
				<div class="row">
					<div class="col-md-6">
						{!! Html::linkRoute('posts.edit','Edit', array( $post->id ), array('class' => 'btn btn-primary btn-block' )) !!}
					</div>
					<div class="col-md-6">
					{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => "DELETE"]) !!}
						{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block' ]) }}
					{!! Form::close() !!}
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						{!! Html::linkRoute('posts.index','<< See All Posts', [],['class' => 'btn btn-default btn-block' ]) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection