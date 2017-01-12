@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('category.page_header.add') }}</h1>
        </div>
        <p>{{ trans('category.description.add') }}</p>
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
         <form action="{{ route('categories.store') }}" method="post">
        {{ csrf_field() }}
            <fieldset>
            <legend>{{ trans('category.legend_form.add') }}</legend>
            <div class="form-group">
                <label for="name">{{ trans('category.field_name.name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="{{ trans('category.placeholder.add.name') }}" name="name" required="required">
                @if ($errors->has('name'))
                     <small class=error>{{ $errors->first('name', ':message') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="parent">{{ trans('category.field_name.parent_id') }}</label>
                <select class="form-control" name="parent_id">
                    <option value="{{ trans('category.root.value') }}">{{ trans('category.root.name') }}</option>
                    @foreach ($categories as $key => $val)
                    <option value="{!! $key !!}">{!! $val !!}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-default" type="submit">{{ trans('category.button.store') }}</button>
            </fieldset>
        </form>
@stop