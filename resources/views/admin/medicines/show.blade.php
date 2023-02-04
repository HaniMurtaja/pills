@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.medicine.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.id') }}
                        </th>
                        <td>
                            {{ $medicine->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.med_generic_name') }}
                        </th>
                        <td>
                            {{ $medicine->med_generic_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.med_scientific_name') }}
                        </th>
                        <td>
                            {{ $medicine->med_scientific_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.med_quantity') }}
                        </th>
                        <td>
                            {{ $medicine->med_quantity }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.med_expire_date') }}
                        </th>
                        <td>
                            {{ $medicine->med_expire_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.user_med') }}
                        </th>
                        <td>
                            {{ $medicine->user_med->user ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.medicine.fields.care_med') }}
                        </th>
                        <td>
                            @foreach($medicine->care_meds as $key => $care_med)
                                <span class="label label-info">{{ $care_med->careby }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.medicines.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection