@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.organe.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.organes.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.organe.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', '') }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.organe.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reihenfolge">{{ trans('cruds.organe.fields.reihenfolge') }}</label>
                <input class="form-control {{ $errors->has('reihenfolge') ? 'is-invalid' : '' }}" type="number" name="reihenfolge" id="reihenfolge" value="{{ old('reihenfolge', '1') }}" step="1" required>
                @if($errors->has('reihenfolge'))
                    <span class="text-danger">{{ $errors->first('reihenfolge') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.organe.fields.reihenfolge_helper') }}</span>
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