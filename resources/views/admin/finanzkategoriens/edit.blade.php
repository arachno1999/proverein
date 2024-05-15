@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.finanzkategorien.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.finanzkategoriens.update", [$finanzkategorien->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.finanzkategorien.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', $finanzkategorien->bezeichnung) }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finanzkategorien.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.finanzkategorien.fields.type') }}</label>
                @foreach(App\Models\Finanzkategorien::TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', $finanzkategorien->type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finanzkategorien.fields.type_helper') }}</span>
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