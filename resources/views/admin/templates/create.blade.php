@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.template.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.templates.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.template.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.template.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="content">{{ trans('cruds.template.fields.content') }}</label>
                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" id="content" required>{{ old('content') }}</textarea>
                @if($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.template.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="code_mobile">{{ trans('cruds.template.fields.code_mobile') }}</label>
                <textarea class="form-control {{ $errors->has('code_mobile') ? 'is-invalid' : '' }}" name="code_mobile" id="code_mobile">{{ old('code_mobile') }}</textarea>
                @if($errors->has('code_mobile'))
                    <span class="text-danger">{{ $errors->first('code_mobile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.template.fields.code_mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection