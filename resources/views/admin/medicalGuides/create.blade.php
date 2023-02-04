@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.medicalGuide.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.medical-guides.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="guide_name">{{ trans('cruds.medicalGuide.fields.guide_name') }}</label>
                <input class="form-control {{ $errors->has('guide_name') ? 'is-invalid' : '' }}" type="text" name="guide_name" id="guide_name" value="{{ old('guide_name', '') }}" required>
                @if($errors->has('guide_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.guide_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guide_category">{{ trans('cruds.medicalGuide.fields.guide_category') }}</label>
                <input class="form-control {{ $errors->has('guide_category') ? 'is-invalid' : '' }}" type="text" name="guide_category" id="guide_category" value="{{ old('guide_category', '') }}" required>
                @if($errors->has('guide_category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide_category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.guide_category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guide_phone">{{ trans('cruds.medicalGuide.fields.guide_phone') }}</label>
                <input class="form-control {{ $errors->has('guide_phone') ? 'is-invalid' : '' }}" type="text" name="guide_phone" id="guide_phone" value="{{ old('guide_phone', '') }}" required>
                @if($errors->has('guide_phone'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide_phone') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.guide_phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guide_image">{{ trans('cruds.medicalGuide.fields.guide_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('guide_image') ? 'is-invalid' : '' }}" id="guide_image-dropzone">
                </div>
                @if($errors->has('guide_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.guide_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guide_working_hours">{{ trans('cruds.medicalGuide.fields.guide_working_hours') }}</label>
                <input class="form-control {{ $errors->has('guide_working_hours') ? 'is-invalid' : '' }}" type="text" name="guide_working_hours" id="guide_working_hours" value="{{ old('guide_working_hours', '') }}" required>
                @if($errors->has('guide_working_hours'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide_working_hours') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.guide_working_hours_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.medicalGuide.fields.guide_status') }}</label>
                <select class="form-control {{ $errors->has('guide_status') ? 'is-invalid' : '' }}" name="guide_status" id="guide_status" required>
                    <option value disabled {{ old('guide_status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\MedicalGuide::GUIDE_STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('guide_status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('guide_status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide_status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.guide_status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="guide_address">{{ trans('cruds.medicalGuide.fields.guide_address') }}</label>
                <input class="form-control {{ $errors->has('guide_address') ? 'is-invalid' : '' }}" type="text" name="guide_address" id="guide_address" value="{{ old('guide_address', '') }}" required>
                @if($errors->has('guide_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('guide_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.guide_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.medicalGuide.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', '') }}">
                @if($errors->has('latitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('latitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.medicalGuide.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', '') }}">
                @if($errors->has('longitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('longitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicalGuide.fields.longitude_helper') }}</span>
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
    Dropzone.options.guideImageDropzone = {
    url: '{{ route('admin.medical-guides.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
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
      $('form').find('input[name="guide_image"]').remove()
      $('form').append('<input type="hidden" name="guide_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="guide_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($medicalGuide) && $medicalGuide->guide_image)
      var file = {!! json_encode($medicalGuide->guide_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="guide_image" value="' + file.file_name + '">')
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