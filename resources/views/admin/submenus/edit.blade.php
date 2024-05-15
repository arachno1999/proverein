@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.submenu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.submenus.update", [$submenu->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="webmenu_id">{{ trans('cruds.submenu.fields.webmenu') }}</label>
                <select class="form-control select2 {{ $errors->has('webmenu') ? 'is-invalid' : '' }}" name="webmenu_id" id="webmenu_id" required>
                    @foreach($webmenus as $id => $entry)
                        <option value="{{ $id }}" {{ (old('webmenu_id') ? old('webmenu_id') : $submenu->webmenu->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('webmenu'))
                    <span class="text-danger">{{ $errors->first('webmenu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.submenu.fields.webmenu_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.submenu.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', $submenu->bezeichnung) }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.submenu.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reihenfolge">{{ trans('cruds.submenu.fields.reihenfolge') }}</label>
                <input class="form-control {{ $errors->has('reihenfolge') ? 'is-invalid' : '' }}" type="number" name="reihenfolge" id="reihenfolge" value="{{ old('reihenfolge', $submenu->reihenfolge) }}" step="1" required>
                @if($errors->has('reihenfolge'))
                    <span class="text-danger">{{ $errors->first('reihenfolge') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.submenu.fields.reihenfolge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="beschreibung">{{ trans('cruds.submenu.fields.beschreibung') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('beschreibung') ? 'is-invalid' : '' }}" name="beschreibung" id="beschreibung">{!! old('beschreibung', $submenu->beschreibung) !!}</textarea>
                @if($errors->has('beschreibung'))
                    <span class="text-danger">{{ $errors->first('beschreibung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.submenu.fields.beschreibung_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.submenus.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $submenu->id ?? 0 }}');
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