@extends('template.user')

@section('title')
{{ trans('post.page_title.detail') }}
@endsection

@section('content')
<div class="container">
      <div class="row">
        <div class="col-sm-8 blog-main">
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
</div>
@endsection