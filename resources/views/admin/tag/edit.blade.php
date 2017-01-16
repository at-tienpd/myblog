@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('tag.page_header.edit') }}{{ $tag->tag }}</h1>
        </div>
        <p>{{ trans('tag.description.add') }}</p>
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <table class="table table-hover table-bordered">
               <caption>{{ trans('tag.table_caption.add') }}</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('tag.field_name.tag') }}</th>
                        <th>{{ trans('tag.field_name.edit') }}</th>
                        <th>{{ trans('tag.field_name.delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($tags as $val)
                    <tr>
                        <td>{{ $val -> id }}</td>
                        <td>{{ $val -> tag }}</td>
                        <td><a class="btn btn-default" href="{{ route('tags.edit', $val -> id ) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                        <td><form action="{{ route('tags.destroy', $val -> id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        </form></td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        {{ $tags->links() }}
        <form action="{{ route('tags.update', $tag -> id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <fieldset>
            <legend>{{ trans('tag.legend_form.add') }}</legend>
            <div class="form-group">
                <input type="hidden" name="tag_id" value="{{ $tag->id }}">
                <label for="tag">{{ trans('tag.field_name.tag') }}</label>
                <input type="text" class="form-control" id="tag" placeholder="{{ trans('tag.placeholder.add') }}" name="tag" value="{{ old('tag', $tag->tag) }}">
                @if ($errors->has('tag'))
                     <small class=error>{{ $errors->first('tag', ':message') }}</small>
                @endif
            </div>
            <button class="btn btn-default" type="submit">{{ trans('tag.button.update') }}</button>
            </fieldset>
        </form>
@stop