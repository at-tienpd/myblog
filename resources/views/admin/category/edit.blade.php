@extends('template.admin')
@section('content')
        <div class="page-header">
            <h1>{{ trans('category.page_header.add') }}</h1>
        </div>
        <p>{{ trans('category.description.edit') }}</p>
        @if (Session::has('message'))
            <div class="alert alert-info alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ Session::get('message') }}
            </div>
        @endif
        <table class="table table-hover table-bordered">
               <caption>{{ trans('category.table_caption.edit') }}</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('category.field_name.name') }}</th>
                        <th>{{ trans('category.field_name.parent_id') }}</th>
                        <th>{{ trans('category.field_name.edit') }}</th>
                        <th>{{ trans('category.field_name.delete') }}</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($categories as $val)
                    <tr>
                        <td>{{ $val->id }}</td>
                        <td>{{ $val->name }}</td>
                        <td>
                            @if ($val->parent_id != null)
                                {{ $val->parent_id }}
                            @endif
                        </td>
                        <td><a class="btn btn-default" href="{{ route('categories.edit', $val->id ) }}"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a></td>
                        <td><form action="{{ route('categories.destroy', $val->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" type="submit"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                        </form></td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
        {{ $categories->links() }}
         <form action="{{ route('categories.update', $category->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
            <fieldset>
            <legend>{{ trans('category.legend_form.edit') }}</legend>
            <div class="form-group">
                <label for="name">{{ trans('category.field_name.name') }}</label>
                <input type="text" class="form-control" id="name" placeholder="{{ trans('category.placeholder.add.name') }}" name="name" required="required" value="{{ $category -> name }}">
                @if ($errors->has('name'))
                     <small class=error>{{ $errors->first('name', ':message') }}</small>
                @endif
            </div>
            <div class="form-group">
                <label for="parent">{{ trans('category.field_name.parent_id') }}</label>
                <select class="form-control" name="parent_id">
                    <option value="{{ trans('category.root.value') }}">{{ trans('category.root.name') }}</option>
                    @foreach ($categoriesNested as $key => $val)
                    <option value="{!! $key !!}">{!! $val !!}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-default" type="submit">{{ trans('category.button.update') }}</button>
            </fieldset>
        </form>
@stop