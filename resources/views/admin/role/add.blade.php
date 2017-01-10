@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('role.page_header.add') }}</h1>
        </div>
        <p>{{ trans('role.description.add') }}</p>
        <table class="table table-hover table-bordered">
               <caption>{{ trans('role.table_caption.add') }}</caption>
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
        <form action="{{ route('roles.store') }}" method="post">
        {{ csrf_field() }}
        <fieldset>
            <legend>{{ trans('role.legend_form.add') }}</legend>
            <div class="form-group">
                <label for="name">{{ trans('role.field_name.name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="Name" name="name" required="required">
            </div>
            <div class="form-group">
                <label for="display_name">{{ trans('role.field_name.display_name') }}</label>
                <input type="text" class="form-control" id="display_name" placeholder="Display name" name="display_name" required="required">
            </div>
            <div class="form-group">
                <label for="description">{{ trans('role.field_name.description') }}</label>
                <input type="text" class="form-control" id="description" placeholder="Description" name="description" required="required">
            </div>
            <button class="btn btn-default" type="submit">{{ trans('role.button.store') }}</button>
            </fieldset>
        </form>
@stop