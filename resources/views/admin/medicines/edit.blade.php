@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.medicine.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.medicines.update", [$medicine->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="med_generic_name">{{ trans('cruds.medicine.fields.med_generic_name') }}</label>
                <input class="form-control {{ $errors->has('med_generic_name') ? 'is-invalid' : '' }}" type="text" name="med_generic_name" id="med_generic_name" value="{{ old('med_generic_name', $medicine->med_generic_name) }}" required>
                @if($errors->has('med_generic_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('med_generic_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicine.fields.med_generic_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="med_scientific_name">{{ trans('cruds.medicine.fields.med_scientific_name') }}</label>
                <input class="form-control {{ $errors->has('med_scientific_name') ? 'is-invalid' : '' }}" type="text" name="med_scientific_name" id="med_scientific_name" value="{{ old('med_scientific_name', $medicine->med_scientific_name) }}" required>
                @if($errors->has('med_scientific_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('med_scientific_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicine.fields.med_scientific_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="med_quantity">{{ trans('cruds.medicine.fields.med_quantity') }}</label>
                <input class="form-control {{ $errors->has('med_quantity') ? 'is-invalid' : '' }}" type="text" name="med_quantity" id="med_quantity" value="{{ old('med_quantity', $medicine->med_quantity) }}">
                @if($errors->has('med_quantity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('med_quantity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicine.fields.med_quantity_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="med_expire_date">{{ trans('cruds.medicine.fields.med_expire_date') }}</label>
                <input class="form-control date {{ $errors->has('med_expire_date') ? 'is-invalid' : '' }}" type="text" name="med_expire_date" id="med_expire_date" value="{{ old('med_expire_date', $medicine->med_expire_date) }}" required>
                @if($errors->has('med_expire_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('med_expire_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicine.fields.med_expire_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_med_id">{{ trans('cruds.medicine.fields.user_med') }}</label>
                <select class="form-control select2 {{ $errors->has('user_med') ? 'is-invalid' : '' }}" name="user_med_id" id="user_med_id">
                    @foreach($user_meds as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_med_id') ? old('user_med_id') : $medicine->user_med->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_med'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user_med') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicine.fields.user_med_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="care_meds">{{ trans('cruds.medicine.fields.care_med') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('care_meds') ? 'is-invalid' : '' }}" name="care_meds[]" id="care_meds" multiple required>
                    @foreach($care_meds as $id => $care_med)
                        <option value="{{ $id }}" {{ (in_array($id, old('care_meds', [])) || $medicine->care_meds->contains($id)) ? 'selected' : '' }}>{{ $care_med }}</option>
                    @endforeach
                </select>
                @if($errors->has('care_meds'))
                    <div class="invalid-feedback">
                        {{ $errors->first('care_meds') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.medicine.fields.care_med_helper') }}</span>
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