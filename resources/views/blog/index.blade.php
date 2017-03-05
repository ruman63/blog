@extends('main')
@section('title', '| Archive')
@section('content')

	<div class="row">
        <div class="col-md-12 text-center">
              <h1>Blog Archive</h1>
        </div>
    </div><!--end or header .row-->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
        	<hr>
            @foreach($posts as $post)
            <div class="post">
                <h3>{{ $post->title }}</h3>
                <h5>Published: {{ date('M j, Y' , strtotime($post->created_at)) }}</h5>
                <p>
                    {{ substr(strip_tags($post->body), 0, 300) }} {{ strlen(strip_tags($post->body))>300 ? "..." : "" }}
                </p>
                <a class="btn btn-primary" href="{{ route('blog.single', $post->slug) }}">Read More</a>
            </div>
            <hr>
            @endforeach
            <div class="text-center">
            	{!! $posts->links() !!}
            </div>
        </div>
    </div>

@endsection