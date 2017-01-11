@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('permission.page_header.add') }}</h1>
        </div>
        <p>{{ trans('permission.description.add') }}</p>
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <table class="table table-hover table-bordered">
               <caption>{{ trans('permission.table_caption.add') }}</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('permission.field_name.name') }}</th>
                        <th>{{ trans('permission.field_name.display_name') }}</th>
                        <th>{{ trans('permission.field_name.description') }}</th>
                        <th>{{ trans('permission.field_name.edit') }}</th>
                        <th>{{ trans('permission.field_name.delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($permissions as $val)
                    <tr>
                        <td>{{ $val -> id }}</td>
                        <td>{{ $val -> name }}</td>
                        <td>{{ $val -> display_name }}</td>
                        <td>{{ $val -> description }}</td>
                        <td><a class="btn btn-default" href="{{ route('permissions.edit', $val -> id ) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                        <td><form action="{{ route('permissions.destroy', $val -> id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        </form></td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        <form action="{{ route('permissions.store') }}" method="post">
        {{ csrf_field() }}
        <fieldset>
            <legend>{{ trans('permission.legend_form.add') }}</legend>
            <div class="form-group">
                <label for="name">{{ trans('permission.field_name.name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="required">
                @if ($errors->has('name'))
                     <small class=error>{{ $errors->first('name', ':message') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="display_name">{{ trans('permission.field_name.display_name') }}</label>
                <input type="text" class="form-control" id="display_name" placeholder="Display name" name="display_name" required="required">
                @if ($errors->has('display_name'))
                     <small class=error>{{ $errors->first('display_name', ':message') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="description">{{ trans('permission.field_name.description') }}</label>
                <input type="text" class="form-control" id="description" placeholder="Description" name="description" required="required">
                @if ($errors->has('description'))
                     <small class=error>{{ $errors->first('description', ':description') }}</small>
                @endif
            </div>
            <button class="btn btn-default" type="submit">{{ trans('permission.button.store') }}</button>
            </fieldset>
        </form>
@stop