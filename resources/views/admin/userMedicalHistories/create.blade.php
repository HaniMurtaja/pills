@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userMedicalHistory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-medical-histories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="disease_name">{{ trans('cruds.userMedicalHistory.fields.disease_name') }}</label>
                <input class="form-control {{ $errors->has('disease_name') ? 'is-invalid' : '' }}" type="text" name="disease_name" id="disease_name" value="{{ old('disease_name', '') }}" required>
                @if($errors->has('disease_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disease_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMedicalHistory.fields.disease_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="description">{{ trans('cruds.userMedicalHistory.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}" required>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMedicalHistory.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_history_id">{{ trans('cruds.userMedicalHistory.fields.user_history') }}</label>
                <select class="form-control select2 {{ $errors->has('user_history') ? 'is-invalid' : '' }}" name="user_history_id" id="user_history_id">
                    @foreach($user_histories as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_history_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_history'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_history') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMedicalHistory.fields.user_history_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="care_histories">{{ trans('cruds.userMedicalHistory.fields.care_history') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('care_histories') ? 'is-invalid' : '' }}" name="care_histories[]" id="care_histories" multiple required>
                    @foreach($care_histories as $id => $care_history)
                        <option value="{{ $id }}" {{ in_array($id, old('care_histories', [])) ? 'selected' : '' }}>{{ $care_history }}</option>
                    @endforeach
                </select>
                @if($errors->has('care_histories'))
                    <div class="invalid-feedback">
                        {{ $errors->first('care_histories') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMedicalHistory.fields.care_history_helper') }}</span>
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