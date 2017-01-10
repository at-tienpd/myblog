@extends('template.user')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('home.panel_heading') }}</div>

                <div class="panel-body">
                    {{ trans('home.logged') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
