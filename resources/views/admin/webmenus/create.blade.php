@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.webmenu.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.webmenus.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="bezeichnung">{{ trans('cruds.webmenu.fields.bezeichnung') }}</label>
                <input class="form-control {{ $errors->has('bezeichnung') ? 'is-invalid' : '' }}" type="text" name="bezeichnung" id="bezeichnung" value="{{ old('bezeichnung', '') }}" required>
                @if($errors->has('bezeichnung'))
                    <span class="text-danger">{{ $errors->first('bezeichnung') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.webmenu.fields.bezeichnung_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="reihenfolge">{{ trans('cruds.webmenu.fields.reihenfolge') }}</label>
                <input class="form-control {{ $errors->has('reihenfolge') ? 'is-invalid' : '' }}" type="number" name="reihenfolge" id="reihenfolge" value="{{ old('reihenfolge', '') }}" step="1" required>
                @if($errors->has('reihenfolge'))
                    <span class="text-danger">{{ $errors->first('reihenfolge') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.webmenu.fields.reihenfolge_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.webmenu.fields.tags') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('tags') ? 'is-invalid' : '' }}" name="tags[]" id="tags" multiple>
                    @foreach($tags as $id => $tag)
                        <option value="{{ $id }}" {{ in_array($id, old('tags', [])) ? 'selected' : '' }}>{{ $tag }}</option>
                    @endforeach
                </select>
                @if($errors->has('tags'))
                    <span class="text-danger">{{ $errors->first('tags') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.webmenu.fields.tags_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="template_id">{{ trans('cruds.webmenu.fields.template') }}</label>
                <select class="form-control select2 {{ $errors->has('template') ? 'is-invalid' : '' }}" name="template_id" id="template_id" required>
                    @foreach($templates as $id => $entry)
                        <option value="{{ $id }}" {{ old('template_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('template'))
                    <span class="text-danger">{{ $errors->first('template') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.webmenu.fields.template_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="top_image">{{ trans('cruds.webmenu.fields.top_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('top_image') ? 'is-invalid' : '' }}" id="top_image-dropzone">
                </div>
                @if($errors->has('top_image'))
                    <span class="text-danger">{{ $errors->first('top_image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.webmenu.fields.top_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="slider">{{ trans('cruds.webmenu.fields.slider') }}</label>
                <div class="needsclick dropzone {{ $errors->has('slider') ? 'is-invalid' : '' }}" id="slider-dropzone">
                </div>
                @if($errors->has('slider'))
                    <span class="text-danger">{{ $errors->first('slider') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.webmenu.fields.slider_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="footer">{{ trans('cruds.webmenu.fields.footer') }}</label>
                <div class="needsclick dropzone {{ $errors->has('footer') ? 'is-invalid' : '' }}" id="footer-dropzone">
                </div>
                @if($errors->has('footer'))
                    <span class="text-danger">{{ $errors->first('footer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.webmenu.fields.footer_helper') }}</span>
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
    Dropzone.options.topImageDropzone = {
    url: '{{ route('admin.webmenus.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 2048,
      height: 2048
    },
    success: function (file, response) {
      $('form').find('input[name="top_image"]').remove()
      $('form').append('<input type="hidden" name="top_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="top_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($webmenu) && $webmenu->top_image)
      var file = {!! json_encode($webmenu->top_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="top_image" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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
    var uploadedSliderMap = {}
Dropzone.options.sliderDropzone = {
    url: '{{ route('admin.webmenus.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 2048,
      height: 2048
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="slider[]" value="' + response.name + '">')
      uploadedSliderMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedSliderMap[file.name]
      }
      $('form').find('input[name="slider[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($webmenu) && $webmenu->slider)
      var files = {!! json_encode($webmenu->slider) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="slider[]" value="' + file.file_name + '">')
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
    Dropzone.options.footerDropzone = {
    url: '{{ route('admin.webmenus.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 2048,
      height: 2048
    },
    success: function (file, response) {
      $('form').find('input[name="footer"]').remove()
      $('form').append('<input type="hidden" name="footer" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="footer"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($webmenu) && $webmenu->footer)
      var file = {!! json_encode($webmenu->footer) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="footer" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
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