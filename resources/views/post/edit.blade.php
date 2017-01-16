@extends('template.user')

@section('title')
{{ trans('post.page_title.add') }}
@endsection

@push('scripts')
  <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
  <script type="text/javascript">
  tinymce.init({
        selector : "textarea#body",
        plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
        toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
        relative_urls : false,
    });
  </script>
@endpush

@section('content')
<div class="container">
    <div class="page-header">
        <h1>{{ trans('post.page_header.edit') }} - {{ $post->title }}</h1>
    </div>
    <p>{{ trans('post.description.edit') }}</p>
    @if (Session::has('message'))
    <div class="alert alert-info alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('message') }}
    </div>
    @endif
    <form action="{{ route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="form-group">
            <label for="title">{{ trans('post.field_name.title') }}</label>
            <input id="title" value="{{ old('title', $post->title) }}" placeholder="{{ trans('post.placeholder.title') }}" type="text" class="form-control" name="title" />
            @if ($errors->has('title'))
                <small class=error>{{ $errors->first('title', ':message') }}</small>
            @endif
        </div>
        <img class="img_post_edit" src="{{ config('app.url').'/'.config('auth.image_path_post'). $post->image}}">
        <div class="form-group">
            <label for="image">{{ trans('post.field_name.image') }}</label>
            <input id="image" type="file" class="form-control" name="image" value="{{ old('image', $post->image) }}" autofocus>
            @if ($errors->has('image'))
                <small class=error>{{ $errors->first('image', ':message') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="description">{{ trans('post.field_name.description') }}</label>
            <textarea name='description' class="form-control" placeholder="{{ trans('post.placeholder.description') }}">{{ old('description', $post->description) }}</textarea>
            @if ($errors->has('description'))
                <small class=error>{{ $errors->first('description', ':message') }}</small>
            @endif
        </div>
  
        <div class="form-group">
            <label for="body">{{ trans('post.field_name.body') }}</label>
            <textarea name="body" id="body" class="form-control" placeholder="{{ trans('post.placeholder.body') }}">{!! old('body', $post->body) !!}</textarea>
            @if ($errors->has('body'))
                <small class=error>{{ $errors->first('body', ':message') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="tags">{{ trans('post.field_name.tags') }}</label>
            <input id="tags" type="text" class="form-control" placeholder="{{ trans('post.placeholder.tags') }}" name="tags" value="{{ old('tags', isset($tags)? implode(',', $tags) : '')}}" autofocus>
            @if ($errors->has('tags'))
                <small class=error>{{ $errors->first('tags', ':message') }}</small>
            @endif
        </div>

        <div class="form-group">
            <label for="category_id">{{ trans('post.field_name.category.name') }}</label>
            <select class="form-control" name="category_id" id="category_id">
                <option value="">{{ trans('post.field_name.category.option_default') }}</option>
                @foreach ($categoriesNested as $key => $val)
                <option value="{!! $key !!}" @if($key == $post->category_id) selected @endif>{!! $val !!}</option>
                @endforeach
            </select>
            @if ($errors->has('category_id'))
                <small class=error>{{ $errors->first('category_id', ':message') }}</small>
            @endif
        </div>

        <input type="submit" class="btn btn-success" value = "{{ trans('post.button.update') }}"/>
    </form>
</div>
@endsection