@extends('main')

@section('title', '| Create New Post')

@section('styles')
  {{ Html::style('css/select2.min.css') }}
  <script src="//cloud.tinymce.com/stable/tinymce.min.js?apiKey=ufq92xe02j5rgd4onrcl33vmwhqlt81k5i0h5rj785xjfbom"></script>
  <script>
    tinymce.init({ 
      selector:'textarea',
      plugin: 'link',
      menubar: false
    });
  </script>

@endsection

@section('content')

<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1>Write Something...</h1>
    <hr>
    {!! Form::open(array('route' => 'posts.store')) !!}
    
      {{ Form::label('title', 'Title:') }}
      {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
      
      {{ Form::label('slug', 'Slug Url:', ['class' => 'form-spacing-top']) }}
      {{ Form::text('slug', null, ['class' => 'form-control']) }}

      {{ Form::label('category_id', 'Category:', ['class' => 'form-spacing-top']) }}
      <select class="form-control" name="category_id">
        @foreach($categories as $category)
        <option value="{{ $category->id }}"> {{ $category->name }} </option>
        @endforeach
      </select>
      {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
      <select name="tags[]" class="form-control multiple-select" multiple="multiple">
        @foreach($tags as $tag)
        <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
        @endforeach
      </select>

      {{ Form::label('body', 'Post Body:', ['class' => 'form-spacing-top']) }}
      {{ Form::textarea('body',null , ['class' => 'form-control', 'placeholder' => 'Write something here...' ]) }}

      {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block btn-h1-spacing'))}}
    {!! Form::close() !!}
  </div>
</div>
@endsection
@section('scripts')

  {{ Html::script('js/select2.min.js') }}

  <script type='text/javascript'>
    $(".multiple-select").select2();
  </script>

@endsection
