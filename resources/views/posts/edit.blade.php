@extends('main')

@section('title', '| Edit Post')
@section('styles')
  {{ Html::style('css/select2.min.css') }}
@endsection
@section('content')

<div class="row">
  {!! Form::model( $post, ['route' => ['posts.update', $post->id ], 'method' => 'PUT'] ) !!}
  <div class="col-md-8 ">
    
    
      {{ Form::label('title', 'Title:') }}
      {{ Form::text('title',  null, ['class' => 'form-control input-lg']) }}

      {{ Form::label('slug', 'Url Slug:', ['class' => 'form-spacing-top']) }}
      {{ Form::text('slug',  null, ['class' => 'form-control']) }}

      {{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
      {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}
      
      {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
      {{ Form::select('tags[]', $tags, null, ['class' => 'form-control multiple-select', 'multiple' => 'multiple']) }}
      
      {{ Form::label('body', 'Post Body:', ['class' => 'form-spacing-top']) }}
      {{ Form::textarea('body', null , ['class' => 'form-control ']) }}
  </div>
  <div class="col-md-4">
    <div class="well">
      <dl class="dl-horizontal">
        <label>Created At:</label>
        <p>{{ date('M j, Y h:i A',strtotime($post->created_at)) }}</p>
      </dl>
      <dl class="dl-horizontal">
        <label>Last Modified:</label>
        <p>{{ date('M j, Y h:i A',strtotime($post->updated_at)) }}</p>
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
@section('scripts')

  {{ Html::script('js/select2.min.js') }}

  <script type='text/javascript'>
    $(".multiple-select").select2();
    $(".multiple-select").select2().val({{ json_encode($post->tags()->getrelatedIds()) }}).trigger('change');
  </script>

@endsection
