@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('comment.page_header.admin') }}</h1>
        </div>
        <p>{{ trans('comment.description.admin') }}</p>
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <table class="table table-hover table-bordered">
               <caption>{{ trans('comment.table_caption.admin') }}</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('comment.field_name.body') }}</th>
                        <th>{{ trans('comment.field_name.post') }}</th>
                        <th>{{ trans('comment.field_name.user') }}</th>
                        <th>{{ trans('comment.field_name.publish') }}</th>
                        <th>{{ trans('comment.field_name.delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($comments as $val)
                    <tr>
                        <td>{{ $val -> id }}</td>
                        <td>{{ $val -> body }}</td>
                        <th>{{ $val ->post->title }}</th>
                        <th>{{ $val ->user->name }}</th>
                        <th>
                            <form action="{{ route('publish-comments')}}" method="post">
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
                        <td><form action="{{ route('comments.destroy', $val -> id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        </form></td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        {{ $comments->links() }}
@stop