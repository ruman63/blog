@extends('main')

@section('title', 'Edit Post')

@section('content')

<div class="row">
  {!! Form::model( $post, ['route' => ['posts.update', $post->id ], 'method' => 'PUT'] ) !!}
  <div class="col-md-8 ">
    
    
      {{ Form::label('title', 'Title:') }}
      
      {{ Form::text('title',  null, ['class' => 'form-control input-lg']) }}
      
      {{ Form::label('body', 'Post Body:', ['class' => 'form-spacing-top']) }}
      
      {{ Form::textarea('body', null , ['class' => 'form-control ']) }}
  </div>
  <div class="col-md-4">
    <div class="well">
      <dl class="dl-horizontal">
        <dt>Created At:</dt>
        <dd>{{ date('M j, Y h:i A',strtotime($post->created_at)) }}</dd>
      </dl>
      <dl class="dl-horizontal">
        <dt>Last Modified:</dt>
        <dd>{{ date('M j, Y h:i A',strtotime($post->updated_at)) }}</dd>
      </dl>
      <hr>
      <div class="row">
        <div class="col-md-6">
          {!! Html::linkRoute('posts.show','Cancel', array( $post->id ), array('class' => 'btn btn-danger btn-block' )) !!}
        </div>
        <div class="col-md-6">
          {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block'] ) }}
        </div>
      </div><!--end of row-->
    </div><!--end of well-->
  </div><!--end of sidebar -->
    {!! Form::close() !!}
</div><!--end of row (form)-->
@endsection