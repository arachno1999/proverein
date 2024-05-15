@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.satzung.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.satzungs.update", [$satzung->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="paragraph">{{ trans('cruds.satzung.fields.paragraph') }}</label>
                <input class="form-control {{ $errors->has('paragraph') ? 'is-invalid' : '' }}" type="number" name="paragraph" id="paragraph" value="{{ old('paragraph', $satzung->paragraph) }}" step="1" required>
                @if($errors->has('paragraph'))
                    <span class="text-danger">{{ $errors->first('paragraph') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.satzung.fields.paragraph_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="titel">{{ trans('cruds.satzung.fields.titel') }}</label>
                <input class="form-control {{ $errors->has('titel') ? 'is-invalid' : '' }}" type="text" name="titel" id="titel" value="{{ old('titel', $satzung->titel) }}" required>
                @if($errors->has('titel'))
                    <span class="text-danger">{{ $errors->first('titel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.satzung.fields.titel_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="inhalt">{{ trans('cruds.satzung.fields.inhalt') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('inhalt') ? 'is-invalid' : '' }}" name="inhalt" id="inhalt">{!! old('inhalt', $satzung->inhalt) !!}</textarea>
                @if($errors->has('inhalt'))
                    <span class="text-danger">{{ $errors->first('inhalt') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.satzung.fields.inhalt_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.satzungs.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $satzung->id ?? 0 }}');
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