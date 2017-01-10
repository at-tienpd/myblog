@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('role.page_header.list') }}</h1>
        </div>
        <p>{{ trans('role.description.list') }}</p>
        <form action="{{ route('set-role') }}" method="post">
        {{ csrf_field() }}
            <table class="table table-hover table-bordered">
                <caption>{{ trans('role.table_caption.list') }}</caption>
                <thead>
                    <tr>
                        <th>{{ trans('role.user') }}</th>
                        @foreach($roles as $role)
                        <th>{{ $role->display_name }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                   @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        @foreach ($roles as $role)
                        <td>
                            @if ($user->hasRole($role->name))
                                <input type="checkbox" name="roles[{{ $role->id }}][users][]" value="{{ $user->id }}" checked="checked">
                            @else
                                <input type="checkbox" name="roles[{{ $role->id }}][users][]" value="{{ $user->id }}">
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button class="btn btn-default" type="submit">{{ trans('role.button.set') }}</button>
        </form>
        <p>{{ trans('role.create') }}<a href="{{ route('roles.create') }}">here</a></p>
@stop