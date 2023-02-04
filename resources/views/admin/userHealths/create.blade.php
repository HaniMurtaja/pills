@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userHealth.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-healths.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="careby">{{ trans('cruds.userHealth.fields.careby') }}</label>
                <input class="form-control {{ $errors->has('careby') ? 'is-invalid' : '' }}" type="number" name="careby" id="careby" value="{{ old('careby', '') }}" step="1" required>
                @if($errors->has('careby'))
                    <div class="invalid-feedback">
                        {{ $errors->first('careby') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.careby_id_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.userHealth.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.userHealth.fields.gender') }}</label>
                <select class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender" id="gender" required>
                    <option value disabled {{ old('gender', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\UserHealth::GENDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('gender', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="dob">{{ trans('cruds.userHealth.fields.dob') }}</label>
                <input class="form-control date {{ $errors->has('dob') ? 'is-invalid' : '' }}" type="text" name="dob" id="dob" value="{{ old('dob') }}" required>
                @if($errors->has('dob'))
                    <div class="invalid-feedback">
                        {{ $errors->first('dob') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.dob_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="blood_pressure">{{ trans('cruds.userHealth.fields.blood_pressure') }}</label>
                <input class="form-control {{ $errors->has('blood_pressure') ? 'is-invalid' : '' }}" type="text" name="blood_pressure" id="blood_pressure" value="{{ old('blood_pressure', '') }}" required>
                @if($errors->has('blood_pressure'))
                    <div class="invalid-feedback">
                        {{ $errors->first('blood_pressure') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.blood_pressure_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="blood_group">{{ trans('cruds.userHealth.fields.blood_group') }}</label>
                <input class="form-control {{ $errors->has('blood_group') ? 'is-invalid' : '' }}" type="text" name="blood_group" id="blood_group" value="{{ old('blood_group', '') }}" required>
                @if($errors->has('blood_group'))
                    <div class="invalid-feedback">
                        {{ $errors->first('blood_group') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.blood_group_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="height">{{ trans('cruds.userHealth.fields.height') }}</label>
                <input class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}" type="number" name="height" id="height" value="{{ old('height', '') }}" step="0.01" required>
                @if($errors->has('height'))
                    <div class="invalid-feedback">
                        {{ $errors->first('height') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.height_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="weight">{{ trans('cruds.userHealth.fields.weight') }}</label>
                <input class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}" type="number" name="weight" id="weight" value="{{ old('weight', '') }}" step="0.01" required>
                @if($errors->has('weight'))
                    <div class="invalid-feedback">
                        {{ $errors->first('weight') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.weight_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bmi">{{ trans('cruds.userHealth.fields.bmi') }}</label>
                <input class="form-control {{ $errors->has('bmi') ? 'is-invalid' : '' }}" type="number" name="bmi" id="bmi" value="{{ old('bmi', '') }}" step="0.01" required>
                @if($errors->has('bmi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bmi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.bmi_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_cholestrol">{{ trans('cruds.userHealth.fields.total_cholestrol') }}</label>
                <input class="form-control {{ $errors->has('total_cholestrol') ? 'is-invalid' : '' }}" type="text" name="total_cholestrol" id="total_cholestrol" value="{{ old('total_cholestrol', '') }}" required>
                @if($errors->has('total_cholestrol'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_cholestrol') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.total_cholestrol_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="ldl_cholestrol">{{ trans('cruds.userHealth.fields.ldl_cholestrol') }}</label>
                <input class="form-control {{ $errors->has('ldl_cholestrol') ? 'is-invalid' : '' }}" type="text" name="ldl_cholestrol" id="ldl_cholestrol" value="{{ old('ldl_cholestrol', '') }}" required>
                @if($errors->has('ldl_cholestrol'))
                    <div class="invalid-feedback">
                        {{ $errors->first('ldl_cholestrol') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.ldl_cholestrol_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="hdl_cholestrol">{{ trans('cruds.userHealth.fields.hdl_cholestrol') }}</label>
                <input class="form-control {{ $errors->has('hdl_cholestrol') ? 'is-invalid' : '' }}" type="text" name="hdl_cholestrol" id="hdl_cholestrol" value="{{ old('hdl_cholestrol', '') }}" required>
                @if($errors->has('hdl_cholestrol'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hdl_cholestrol') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.hdl_cholestrol_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="triglycerides">{{ trans('cruds.userHealth.fields.triglycerides') }}</label>
                <input class="form-control {{ $errors->has('triglycerides') ? 'is-invalid' : '' }}" type="text" name="triglycerides" id="triglycerides" value="{{ old('triglycerides', '') }}" required>
                @if($errors->has('triglycerides'))
                    <div class="invalid-feedback">
                        {{ $errors->first('triglycerides') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.triglycerides_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="glucose">{{ trans('cruds.userHealth.fields.glucose') }}</label>
                <input class="form-control {{ $errors->has('glucose') ? 'is-invalid' : '' }}" type="text" name="glucose" id="glucose" value="{{ old('glucose', '') }}" required>
                @if($errors->has('glucose'))
                    <div class="invalid-feedback">
                        {{ $errors->first('glucose') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.glucose_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.userHealth.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userHealth.fields.user_helper') }}</span>
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