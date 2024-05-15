@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.mitglied.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.mitglieds.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="profile">{{ trans('cruds.mitglied.fields.profile') }}</label>
                <div class="needsclick dropzone {{ $errors->has('profile') ? 'is-invalid' : '' }}" id="profile-dropzone">
                </div>
                @if($errors->has('profile'))
                    <span class="text-danger">{{ $errors->first('profile') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.profile_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.mitglied.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="birthday">{{ trans('cruds.mitglied.fields.birthday') }}</label>
                <input class="form-control date {{ $errors->has('birthday') ? 'is-invalid' : '' }}" type="text" name="birthday" id="birthday" value="{{ old('birthday') }}" required>
                @if($errors->has('birthday'))
                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.birthday_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="type_id">{{ trans('cruds.mitglied.fields.type') }}</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type_id" id="type_id" required>
                    @foreach($types as $id => $entry)
                        <option value="{{ $id }}" {{ old('type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="anrede">{{ trans('cruds.mitglied.fields.anrede') }}</label>
                <input class="form-control {{ $errors->has('anrede') ? 'is-invalid' : '' }}" type="text" name="anrede" id="anrede" value="{{ old('anrede', '') }}" required>
                @if($errors->has('anrede'))
                    <span class="text-danger">{{ $errors->first('anrede') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.anrede_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.mitglied.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="eintritt">{{ trans('cruds.mitglied.fields.eintritt') }}</label>
                <input class="form-control date {{ $errors->has('eintritt') ? 'is-invalid' : '' }}" type="text" name="eintritt" id="eintritt" value="{{ old('eintritt') }}" required>
                @if($errors->has('eintritt'))
                    <span class="text-danger">{{ $errors->first('eintritt') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.eintritt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="austritt">{{ trans('cruds.mitglied.fields.austritt') }}</label>
                <input class="form-control date {{ $errors->has('austritt') ? 'is-invalid' : '' }}" type="text" name="austritt" id="austritt" value="{{ old('austritt') }}">
                @if($errors->has('austritt'))
                    <span class="text-danger">{{ $errors->first('austritt') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.austritt_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.mitglied.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anschrift">{{ trans('cruds.mitglied.fields.anschrift') }}</label>
                <textarea class="form-control {{ $errors->has('anschrift') ? 'is-invalid' : '' }}" name="anschrift" id="anschrift">{{ old('anschrift') }}</textarea>
                @if($errors->has('anschrift'))
                    <span class="text-danger">{{ $errors->first('anschrift') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.anschrift_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="organs">{{ trans('cruds.mitglied.fields.organ') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('organs') ? 'is-invalid' : '' }}" name="organs[]" id="organs" multiple>
                    @foreach($organs as $id => $organ)
                        <option value="{{ $id }}" {{ in_array($id, old('organs', [])) ? 'selected' : '' }}>{{ $organ }}</option>
                    @endforeach
                </select>
                @if($errors->has('organs'))
                    <span class="text-danger">{{ $errors->first('organs') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.mitglied.fields.organ_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="tags">{{ trans('cruds.mitglied.fields.tag') }}</label>
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
                <span class="help-block">{{ trans('cruds.mitglied.fields.tag_helper') }}</span>
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
    Dropzone.options.profileDropzone = {
    url: '{{ route('admin.mitglieds.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="profile"]').remove()
      $('form').append('<input type="hidden" name="profile" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="profile"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($mitglied) && $mitglied->profile)
      var file = {!! json_encode($mitglied->profile) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="profile" value="' + file.file_name + '">')
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