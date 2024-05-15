@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.texte.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.textes.update", [$texte->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.texte.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', $texte->bezeichnung) }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.texte.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="titel">{{ trans('cruds.texte.fields.titel') }}</label>
                <input class="form-control {{ $errors->has('titel') ? 'is-invalid' : '' }}" type="text" name="titel" id="titel" value="{{ old('titel', $texte->titel) }}">
                @if($errors->has('titel'))
                    <span class="text-danger">{{ $errors->first('titel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.texte.fields.titel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="offiziell">{{ trans('cruds.texte.fields.offiziell') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('offiziell') ? 'is-invalid' : '' }}" name="offiziell" id="offiziell">{!! old('offiziell', $texte->offiziell) !!}</textarea>
                @if($errors->has('offiziell'))
                    <span class="text-danger">{{ $errors->first('offiziell') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.texte.fields.offiziell_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="persoenlich">{{ trans('cruds.texte.fields.persoenlich') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('persoenlich') ? 'is-invalid' : '' }}" name="persoenlich" id="persoenlich">{!! old('persoenlich', $texte->persoenlich) !!}</textarea>
                @if($errors->has('persoenlich'))
                    <span class="text-danger">{{ $errors->first('persoenlich') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.texte.fields.persoenlich_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.textes.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $texte->id ?? 0 }}');
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