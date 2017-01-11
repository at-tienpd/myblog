@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('permission.page_header.list') }}</h1>
        </div>
        <p>{{ trans('permission.description.list') }}</p>
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <form action="{{ route('set-permission') }}" method="post">
        {{ csrf_field() }}
            <table class="table table-hover table-bordered">
               <caption>{{ trans('permission.table_caption.list') }}</caption>
                <thead>
                    <tr>
                        <th>{{ trans('permission.permission') }}</th>
                        @foreach($roles as $role)
                        <th>{{ $role->display_name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                   @foreach($permissions as $permission)
                    <tr>
                        <td>{{ $permission->display_name }}<small><i>{{ '  '.$permission->description }}</i></small></td>
                        @foreach ($roles as $role)
                        <td>
                            @if ($permission->hasRole($role->name))
                                <input type="checkbox" name="roles[{{ $role->id }}][permissions][]" value="{{ $permission->id }}" checked="checked">
                            @else
                                <input type="checkbox" name="roles[{{ $role->id }}][permissions][]" value="{{ $permission->id }}">
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-default" type="submit">{{ trans('permission.button.set') }}</button>
        </form>
        <p>{{ trans('permission.create') }}<a href="{{ route('permissions.create') }}">here</a></p>
@stop