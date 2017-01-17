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

