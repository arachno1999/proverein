@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.finanzen.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.finanzens.update", [$finanzen->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="datum">{{ trans('cruds.finanzen.fields.datum') }}</label>
                <input class="form-control date {{ $errors->has('datum') ? 'is-invalid' : '' }}" type="text" name="datum" id="datum" value="{{ old('datum', $finanzen->datum) }}" required>
                @if($errors->has('datum'))
                    <span class="text-danger">{{ $errors->first('datum') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finanzen.fields.datum_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.finanzen.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', $finanzen->bezeichnung) }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finanzen.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="betrag">{{ trans('cruds.finanzen.fields.betrag') }}</label>
                <input class="form-control {{ $errors->has('betrag') ? 'is-invalid' : '' }}" type="number" name="betrag" id="betrag" value="{{ old('betrag', $finanzen->betrag) }}" step="0.01" required>
                @if($errors->has('betrag'))
                    <span class="text-danger">{{ $errors->first('betrag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finanzen.fields.betrag_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="kategorie_id">{{ trans('cruds.finanzen.fields.kategorie') }}</label>
                <select class="form-control select2 {{ $errors->has('kategorie') ? 'is-invalid' : '' }}" name="kategorie_id" id="kategorie_id" required>
                    @foreach($kategories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('kategorie_id') ? old('kategorie_id') : $finanzen->kategorie->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('kategorie'))
                    <span class="text-danger">{{ $errors->first('kategorie') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.finanzen.fields.kategorie_helper') }}</span>
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