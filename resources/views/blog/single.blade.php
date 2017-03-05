@extends('main')
<!--This is done to escape title which otherwise makes title vulnerable to xss..-->
<?php $titleTag=htmlspecialchars($post->title); ?>
@section('title', "| $titleTag")

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>{{ $post->title }}</h1>
      <br>
      <p class="lead">{!! $post->body !!}</p>
      <br>
      <p>Posted in {{ $post->category->name }}</p>
      <hr>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      @if($post->comments->count() > 0)
        <div class="title-comments"><h3><span class="glyphicon glyphicon-comment"></span> {{ $post->comments->count() }} Comments</h3></div>
      @endif
      @foreach($post->comments as $comment)
        <div class="comment">
          <div class="comment-head">
            <img src={{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($comment->email))) . '?s=50&d=monsterid' }} class="comment-author-img">
            <div class="comment-head-text">
              <h4>{{ $comment->name }} <small>({{ $comment->email }})</small></h4>
              <p>{{ date('D F j, Y g:i a', strtotime($comment->created_at)) }}</p>
            </div>
          </div> 
          <div class="comment-body">
            <p>{{ $comment->comment }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div id="comment-form" class="comment">
        <h4>Add Comment</h4>
        {!! Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) !!}
          <div class="row">
            <div class="col-md-6">
              {{ Form::label('name', 'Name:') }}
              {{ Form::text('name', null, ['class' => 'form-control input-sm']) }}
            </div>
            <div class="col-md-6">
              {{ Form::label('email', 'Email:') }}
              {{ Form::email('email', null, ['class' => 'form-control input-sm']) }}
            </div>
            <div class="col-md-12">
              {{ Form::label('comment', 'Comment:') }}
              {{ Form::textarea('comment', null, ['class' => 'form-control input-sm', 'rows' => '4']) }}
            </div>
          </div>
          {{ Form::submit('Post Comment', ['class' => 'btn btn-success btn-h1-spacing btn-sm']) }}
        {!! Form::close() !!}
    </div>
    </div>
  </div>
  
@endsection