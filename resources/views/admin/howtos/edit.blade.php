@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.howto.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.howtos.update", [$howto->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.howto.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', $howto->bezeichnung) }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.howto.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beschreibung">{{ trans('cruds.howto.fields.beschreibung') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('beschreibung') ? 'is-invalid' : '' }}" name="beschreibung" id="beschreibung">{!! old('beschreibung', $howto->beschreibung) !!}</textarea>
                @if($errors->has('beschreibung'))
                    <span class="text-danger">{{ $errors->first('beschreibung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.howto.fields.beschreibung_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.howto.fields.tag') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ (in_array($id, old('tags', [])) || $howto->tags->contains($id)) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.howto.fields.tag_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.howtos.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $howto->id ?? 0 }}');
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