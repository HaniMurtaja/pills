@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.service.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.services.update", [$service->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="service_name">{{ trans('cruds.service.fields.service_name') }}</label>
                <input class="form-control {{ $errors->has('service_name') ? 'is-invalid' : '' }}" type="text" name="service_name" id="service_name" value="{{ old('service_name', $service->service_name) }}" required>
                @if($errors->has('service_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_description">{{ trans('cruds.service.fields.service_description') }}</label>
                <input class="form-control {{ $errors->has('service_description') ? 'is-invalid' : '' }}" type="text" name="service_description" id="service_description" value="{{ old('service_description', $service->service_description) }}">
                @if($errors->has('service_description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_price">{{ trans('cruds.service.fields.service_price') }}</label>
                <input class="form-control {{ $errors->has('service_price') ? 'is-invalid' : '' }}" type="number" name="service_price" id="service_price" value="{{ old('service_price', $service->service_price) }}" step="1">
                @if($errors->has('service_price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_image">{{ trans('cruds.service.fields.service_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('service_image') ? 'is-invalid' : '' }}" id="service_image-dropzone">
                </div>
                @if($errors->has('service_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.service.fields.service_image_helper') }}</span>
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
    Dropzone.options.serviceImageDropzone = {
    url: '{{ route('admin.services.storeMedia') }}',
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
      $('form').find('input[name="service_image"]').remove()
      $('form').append('<input type="hidden" name="service_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="service_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($service) && $service->service_image)
      var file = {!! json_encode($service->service_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="service_image" value="' + file.file_name + '">')
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