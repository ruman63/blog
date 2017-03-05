@extends('main')
@section('title', '| Home')
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="jumbotron">
                  <h1>Welcome to My Blog!</h1>
                  <p class="lead">Hi there! Thanks for visting. This is my test website built on laravel. Please Read the latest post</p>
                  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>
                </div>
            </div>
        </div><!--end or header .row-->
        <div class="row">
            <div class="col-md-8">
                @foreach($posts as $post)
                <div class="post">
                    <h2>{{ $post->title }}</h2>
                    <p>
                        {{ substr($post->body, 0, 500) }} {{ strlen($post->body)>500 ? "..." : "" }}
                    </p>
                    <a class="btn btn-primary" href="{{ route('blog.single', $post->slug) }}">Read More</a>
                </div>
                <hr>
                @endforeach
            </div>
            <div class="col-md-3 col-md-offset-1">
               <h2>Sidebar</h2>
            </div>
        </div>
@endsection