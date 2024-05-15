@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.image.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.images.update", [$image->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.image.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $image->name) }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="attachments">{{ trans('cruds.image.fields.attachments') }}</label>
                <div class="needsclick dropzone {{ $errors->has('attachments') ? 'is-invalid' : '' }}" id="attachments-dropzone">
                </div>
                @if($errors->has('attachments'))
                    <span class="text-danger">{{ $errors->first('attachments') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.attachments_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="class">{{ trans('cruds.image.fields.class') }}</label>
                <input class="form-control {{ $errors->has('class') ? 'is-invalid' : '' }}" type="text" name="class" id="class" value="{{ old('class', $image->class) }}">
                @if($errors->has('class'))
                    <span class="text-danger">{{ $errors->first('class') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.image.fields.class_helper') }}</span>
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
    var uploadedAttachmentsMap = {}
Dropzone.options.attachmentsDropzone = {
    url: '{{ route('admin.images.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="attachments[]" value="' + response.name + '">')
      uploadedAttachmentsMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedAttachmentsMap[file.name]
      }
      $('form').find('input[name="attachments[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($image) && $image->attachments)
      var files = {!! json_encode($image->attachments) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="attachments[]" value="' + file.file_name + '">')
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