@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('post.page_header.admin') }}</h1>
        </div>
        <p>{{ trans('post.description.admin') }}</p>
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <table class="table table-hover table-bordered">
               <caption>{{ trans('post.table_caption.admin') }}</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('post.field_name.title') }}</th>
                        <th>{{ trans('post.field_name.image') }}</th>
                        <th>{{ trans('post.field_name.description') }}</th>
                        <th>{{ trans('post.field_name.views') }}</th>
                        <th>{{ trans('post.field_name.status') }}</th>
                        <th>{{ trans('post.field_name.edit') }}</th>
                        <th>{{ trans('post.field_name.delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($posts as $val)
                    <tr>
                        <td>{{ $val -> id }}</td>
                        <td><a href="{{ route('posts.show', $val -> id) }}">{{ $val -> title }}</a></td>
                        <td><img class="img_post_edit" src="{{ config('app.url').'/'.config('auth.image_path_post').$val -> image }}"></td>
                        <td>{{ $val -> description }}</td>
                        <td>{{ $val -> view }}</td>
                        <th>
                            <form action="{{ route('publish-posts')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="status" value="{{ $val -> status }}">
                                <input type="hidden" name="id" value="{{ $val -> id }}">
                                 @if($val -> status == true)
                                <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
                                @else
                                <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></button>
                                @endif
                            </form>
                        </th>
                        <td><a class="btn btn-default" href="{{ route('posts.edit', $val -> id ) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                        <td><form action="{{ route('posts.destroy', $val -> id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        </form></td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        {{ $posts->links() }}
@stop