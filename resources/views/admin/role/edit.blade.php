@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('role.page_header.edit') }} {{ $role -> display_name }}</h1>
        </div>
        <p>{{ trans('role.description.edit') }}</p>
        <table class="table table-hover table-bordered">
                <caption>{{ trans('role.table_caption.edit') }}</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('role.field_name.name') }}</th>
                        <th>{{ trans('role.field_name.display_name') }}</th>
                        <th>{{ trans('role.field_name.description') }}</th>
                        <th>{{ trans('role.field_name.edit') }}</th>
                        <th>{{ trans('role.field_name.delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($roles as $val)
                    <tr>
                        <td>{{ $val -> id }}</td>
                        <td>{{ $val -> name }}</td>
                        <td>{{ $val -> display_name }}</td>
                        <td>{{ $val -> description }}</td>
                        <td><a class="btn btn-default" href="{{ route('roles.edit', $val -> id ) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                        <td><form action="{{ route('roles.destroy', $val -> id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        </form></td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        <form action="{{ route('roles.update', $role -> id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <fieldset>
            <legend>{{ trans('role.legend_form.edit') }}</legend>
            <div class="form-group has-warning">
                <label for="name">{{ trans('role.field_name.name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="{{ trans('role.placeholder.edit.name') }}" name="name" required="required" value="{{ $role -> name }}">
                <span id="name" class="help-block">{{ trans('role.warning.update') }}</span>
                @if ($errors->has('name'))
                     <small class=error>{{ $errors->first('name', ':message') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="display_name">{{ trans('role.field_name.display_name') }}</label>
                <input type="text" class="form-control" id="display_name" placeholder="{{ trans('role.placeholder.edit.display_name') }}" name="display_name" required="required" value="{{ $role -> display_name }}">
                @if ($errors->has('display_name'))
                     <small class=error>{{ $errors->first('display_name', ':message') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="description">{{ trans('role.field_name.description') }}</label>
                <input type="text" class="form-control" id="description" placeholder="{{ trans('role.placeholder.edit.description') }}" name="description" required="required" value="{{ $role -> description }}">
                @if ($errors->has('description'))
                     <small class=error>{{ $errors->first('description', ':message') }}</small>
                @endif
            </div>
            <button class="btn btn-default" type="submit">{{ trans('role.button.update') }}</button>
            </fieldset>
        </form>
@stop