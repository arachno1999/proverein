@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.aktion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.aktions.update", [$aktion->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.aktion.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', $aktion->bezeichnung) }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aktion.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="text_id">{{ trans('cruds.aktion.fields.text') }}</label>
                <select class="form-control select2 {{ $errors->has('text') ? 'is-invalid' : '' }}" name="text_id" id="text_id">
                    @foreach($texts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('text_id') ? old('text_id') : $aktion->text->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('text'))
                    <span class="text-danger">{{ $errors->first('text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aktion.fields.text_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beschreibung">{{ trans('cruds.aktion.fields.beschreibung') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('beschreibung') ? 'is-invalid' : '' }}" name="beschreibung" id="beschreibung">{!! old('beschreibung', $aktion->beschreibung) !!}</textarea>
                @if($errors->has('beschreibung'))
                    <span class="text-danger">{{ $errors->first('beschreibung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aktion.fields.beschreibung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start">{{ trans('cruds.aktion.fields.start') }}</label>
                <input class="form-control datetime {{ $errors->has('start') ? 'is-invalid' : '' }}" type="text" name="start" id="start" value="{{ old('start', $aktion->start) }}">
                @if($errors->has('start'))
                    <span class="text-danger">{{ $errors->first('start') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aktion.fields.start_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="targets">{{ trans('cruds.aktion.fields.target') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('targets') ? 'is-invalid' : '' }}" name="targets[]" id="targets" multiple required>
                    @foreach($targets as $id => $target)
                        <option value="{{ $id }}" {{ (in_array($id, old('targets', [])) || $aktion->targets->contains($id)) ? 'selected' : '' }}>{{ $target }}</option>
                    @endforeach
                </select>
                @if($errors->has('targets'))
                    <span class="text-danger">{{ $errors->first('targets') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aktion.fields.target_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="ort_id">{{ trans('cruds.aktion.fields.ort') }}</label>
                <select class="form-control select2 {{ $errors->has('ort') ? 'is-invalid' : '' }}" name="ort_id" id="ort_id">
                    @foreach($orts as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ort_id') ? old('ort_id') : $aktion->ort->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('ort'))
                    <span class="text-danger">{{ $errors->first('ort') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.aktion.fields.ort_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.aktions.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $aktion->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection