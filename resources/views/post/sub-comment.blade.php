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
                            <strong>{{ $node->user->name }}</strong> @if($node->user->name == $post ->user->name) <b>{{ trans('comment.author') }}</b> @endif <span class="text-muted">{{ trans('comment.comment_at') }}{{ $node->created_at }}</span>@if(count($node->getDescendants())>0) {{ trans('comment.reaply') }} <span class="badge">{{ count($node->getDescendants()) }}</span> @endif
                        </div>
                        <div class="panel-body">
                            {{ $node->body }}
                            <div class="action" >
                            @if($node->likes->count() > 0) <i>{{ $node->likes->count() }} likes this !</i> @endif<br>
                            @if ($node->isLiked)
                            <a href="{{ route('comment.like', $node->id) }}"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span></a>
                            @else
                            <a href="{{ route('comment.like', $node->id) }}"><span class="glyphicon glyphicon-heart-empty" aria-hidden="true"></span></a>
                        @endif
                        </div>
                        </div><!-- /panel-bod y -->

                        @permission('comment_post')
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
                        @endpermission
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