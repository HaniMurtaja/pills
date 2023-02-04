@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medicalGuide.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medical-guides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.id') }}
                        </th>
                        <td>
                            {{ $medicalGuide->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.guide_name') }}
                        </th>
                        <td>
                            {{ $medicalGuide->guide_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.guide_category') }}
                        </th>
                        <td>
                            {{ $medicalGuide->guide_category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.guide_phone') }}
                        </th>
                        <td>
                            {{ $medicalGuide->guide_phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.guide_image') }}
                        </th>
                        <td>
                            @if($medicalGuide->guide_image)
                                <a href="{{ $medicalGuide->guide_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $medicalGuide->guide_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.guide_working_hours') }}
                        </th>
                        <td>
                            {{ $medicalGuide->guide_working_hours }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.guide_status') }}
                        </th>
                        <td>
                            {{ App\Models\MedicalGuide::GUIDE_STATUS_SELECT[$medicalGuide->guide_status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.guide_address') }}
                        </th>
                        <td>
                            {{ $medicalGuide->guide_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.latitude') }}
                        </th>
                        <td>
                            {{ $medicalGuide->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicalGuide.fields.longitude') }}
                        </th>
                        <td>
                            {{ $medicalGuide->longitude }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medical-guides.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection