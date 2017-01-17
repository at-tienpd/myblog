@extends('template.user')

@section('title')
{{ trans('post.page_title.detail') }}
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/comment.css') }}" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
@endpush

@section('content')
<div class="container">
      <div class="row">
      @if (Session::has('message'))
    <div class="alert alert-info alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ Session::get('message') }}
    </div>
    @endif
        <div class="blog-main">
          <div class="blog-post">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            <p class="blog-post-meta">{{ $post->created_at }} by <a href="#">{{ $user ->name }}</a></p>
            <p><i>{{ $post->description }}</i></p>
            <hr>
            <div class="body">{!! $post->body !!}</div>
          </div><!-- /.blog-post -->
          <nav>
            <ul class="pager">
              <li><a href="#"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a></li>
              <li><a href="#"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></li>
            </ul>
          </nav>
        </div>
      </div><!-- /.row -->
      <div class="form-comment">
        <div class="col-sm-1">
            <div class="thumbnail">
              <img class="img-responsive user-photo" src="{{ config('app.url').'/'.config('auth.image_path').Auth::user()->avatar }}">
            </div><!-- /thumbnail -->
        </div>
      <div class="panel panel-default">
        <form action="{{ route('comments.store') }}" method="post">
        {{ csrf_field() }}
          <div class="form-group">
            <textarea type="text" class="form-control" name="body" required="required"></textarea>
            @if ($errors->has('body'))
                <small class=error>{{ $errors->first('body', ':message') }}</small>
            @endif
          </div>
          <input type="hidden" name="post_id" value="{{ $post->id }}">
          <button type="submit" class="btn btn-default">{{ trans('comment.button.store') }}</button>
        </form>
        </div>
      </div>
      <div class="row">
  <!-- Contenedor Principal -->
</div>
</div>

<div class="container">
    <ul class="sidebar-menu">
    @foreach($comments as $node)
        <li>
            <div class="row">
                <div class="col-sm-1">
                    <div class="thumbnail">
                        <img class="img-responsive user-photo" src="{{ config('app.url').'/'.config('auth.image_path').$node->user->avatar }}">
                    </div><!-- /thumbnail -->
                </div><!-- /col-sm-1 -->

                <div class="col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong>{{ $node->user->name }}</strong> <span class="text-muted">{{ trans('comment.comment_at') }}{{ $node->created_at }}</span>
                        </div>
                        <div class="panel-body">
                            {{ $node->body }}
                        </div><!-- /panel-bod y -->
                        <div class="form-comment">
                            <form action="{{ route('comments.store') }}" method="post">
                           {{ csrf_field() }}
                                <div class="form-group">
                                    <textarea required="required" type="text" class="form-control" name="body"></textarea>
                                </div>
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="parent_id" value="{{ $node->id }}">
                                <button type="submit" class="btn btn-default">{{ trans('comment.button.store') }}</button>
                             </form>
                        </div>
                    </div><!-- /panel panel-default -->
                </div><!-- /col-sm-5 -->

            </div>
        </li>
        @if($node->children)
        <li class="sidebar-menu-has-children">
            <ul class="sidebar-submenu">
                @include('post.sub-comment', ['comments' => $node->children])
            </ul>
        </li>
        @endif
    @endforeach
    </ul>
</div>

@endsection