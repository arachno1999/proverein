@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.artikel.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.artikels.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.artikel.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', '') }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="menu_id">{{ trans('cruds.artikel.fields.menu') }}</label>
                <select class="form-control select2 {{ $errors->has('menu') ? 'is-invalid' : '' }}" name="menu_id" id="menu_id" required>
                    @foreach($menus as $id => $entry)
                        <option value="{{ $id }}" {{ old('menu_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('menu'))
                    <span class="text-danger">{{ $errors->first('menu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.menu_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="sichtbar">{{ trans('cruds.artikel.fields.sichtbar') }}</label>
                <input class="form-control date {{ $errors->has('sichtbar') ? 'is-invalid' : '' }}" type="text" name="sichtbar" id="sichtbar" value="{{ old('sichtbar') }}" required>
                @if($errors->has('sichtbar'))
                    <span class="text-danger">{{ $errors->first('sichtbar') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.sichtbar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end">{{ trans('cruds.artikel.fields.end') }}</label>
                <input class="form-control date {{ $errors->has('end') ? 'is-invalid' : '' }}" type="text" name="end" id="end" value="{{ old('end') }}">
                @if($errors->has('end'))
                    <span class="text-danger">{{ $errors->first('end') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.end_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="intro">{{ trans('cruds.artikel.fields.intro') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('intro') ? 'is-invalid' : '' }}" name="intro" id="intro">{!! old('intro') !!}</textarea>
                @if($errors->has('intro'))
                    <span class="text-danger">{{ $errors->first('intro') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.intro_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="fulltext">{{ trans('cruds.artikel.fields.fulltext') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('fulltext') ? 'is-invalid' : '' }}" name="fulltext" id="fulltext">{!! old('fulltext') !!}</textarea>
                @if($errors->has('fulltext'))
                    <span class="text-danger">{{ $errors->first('fulltext') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.fulltext_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="images">{{ trans('cruds.artikel.fields.images') }}</label>
                <div class="needsclick dropzone {{ $errors->has('images') ? 'is-invalid' : '' }}" id="images-dropzone">
                </div>
                @if($errors->has('images'))
                    <span class="text-danger">{{ $errors->first('images') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.images_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="download">{{ trans('cruds.artikel.fields.download') }}</label>
                <div class="needsclick dropzone {{ $errors->has('download') ? 'is-invalid' : '' }}" id="download-dropzone">
                </div>
                @if($errors->has('download'))
                    <span class="text-danger">{{ $errors->first('download') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.download_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.artikel.fields.position') }}</label>
                @foreach(App\Models\Artikel::POSITION_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('position') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="position_{{ $key }}" name="position" value="{{ $key }}" {{ old('position', 'zentral') === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="position_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('position'))
                    <span class="text-danger">{{ $errors->first('position') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.position_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="reihenfolge">{{ trans('cruds.artikel.fields.reihenfolge') }}</label>
                <input class="form-control {{ $errors->has('reihenfolge') ? 'is-invalid' : '' }}" type="number" name="reihenfolge" id="reihenfolge" value="{{ old('reihenfolge', '0') }}" step="1">
                @if($errors->has('reihenfolge'))
                    <span class="text-danger">{{ $errors->first('reihenfolge') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.reihenfolge_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="template_id">{{ trans('cruds.artikel.fields.template') }}</label>
                <select class="form-control select2 {{ $errors->has('template') ? 'is-invalid' : '' }}" name="template_id" id="template_id" required>
                    @foreach($templates as $id => $entry)
                        <option value="{{ $id }}" {{ old('template_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('template'))
                    <span class="text-danger">{{ $errors->first('template') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.template_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="submenu_id">{{ trans('cruds.artikel.fields.submenu') }}</label>
                <select class="form-control select2 {{ $errors->has('submenu') ? 'is-invalid' : '' }}" name="submenu_id" id="submenu_id">
                    @foreach($submenus as $id => $entry)
                        <option value="{{ $id }}" {{ old('submenu_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('submenu'))
                    <span class="text-danger">{{ $errors->first('submenu') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.artikel.fields.submenu_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.artikels.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $artikel->id ?? 0 }}');
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

<script>
    var uploadedImagesMap = {}
Dropzone.options.imagesDropzone = {
    url: '{{ route('admin.artikels.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 20248,
      height: 2048
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
      uploadedImagesMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedImagesMap[file.name]
      }
      $('form').find('input[name="images[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($artikel) && $artikel->images)
      var files = {!! json_encode($artikel->images) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="images[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
<script>
    var uploadedDownloadMap = {}
Dropzone.options.downloadDropzone = {
    url: '{{ route('admin.artikels.storeMedia') }}',
    maxFilesize: 5, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 5
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="download[]" value="' + response.name + '">')
      uploadedDownloadMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedDownloadMap[file.name]
      }
      $('form').find('input[name="download[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($artikel) && $artikel->download)
          var files =
            {!! json_encode($artikel->download) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="download[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection