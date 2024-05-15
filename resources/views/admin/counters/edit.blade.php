@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.counter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.counters.update", [$counter->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.counter.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', $counter->bezeichnung) }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counter.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="key">{{ trans('cruds.counter.fields.key') }}</label>
                <input class="form-control {{ $errors->has('key') ? 'is-invalid' : '' }}" type="text" name="key" id="key" value="{{ old('key', $counter->key) }}" required>
                @if($errors->has('key'))
                    <span class="text-danger">{{ $errors->first('key') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counter.fields.key_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="counter">{{ trans('cruds.counter.fields.counter') }}</label>
                <input class="form-control {{ $errors->has('counter') ? 'is-invalid' : '' }}" type="number" name="counter" id="counter" value="{{ old('counter', $counter->counter) }}" step="1" required>
                @if($errors->has('counter'))
                    <span class="text-danger">{{ $errors->first('counter') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.counter.fields.counter_helper') }}</span>
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