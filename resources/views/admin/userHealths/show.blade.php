@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userHealth.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-healths.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.id') }}
                        </th>
                        <td>
                            {{ $userHealth->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.careby_id') }}
                        </th>
                        <td>
                            {{ $userHealth->careby_id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.name') }}
                        </th>
                        <td>
                            {{ $userHealth->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\UserHealth::GENDER_SELECT[$userHealth->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.dob') }}
                        </th>
                        <td>
                            {{ $userHealth->dob }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.blood_pressure') }}
                        </th>
                        <td>
                            {{ $userHealth->blood_pressure }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.blood_group') }}
                        </th>
                        <td>
                            {{ $userHealth->blood_group }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.height') }}
                        </th>
                        <td>
                            {{ $userHealth->height }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.weight') }}
                        </th>
                        <td>
                            {{ $userHealth->weight }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.bmi') }}
                        </th>
                        <td>
                            {{ $userHealth->bmi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.total_cholestrol') }}
                        </th>
                        <td>
                            {{ $userHealth->total_cholestrol }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.ldl_cholestrol') }}
                        </th>
                        <td>
                            {{ $userHealth->ldl_cholestrol }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.hdl_cholestrol') }}
                        </th>
                        <td>
                            {{ $userHealth->hdl_cholestrol }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.triglycerides') }}
                        </th>
                        <td>
                            {{ $userHealth->triglycerides }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.glucose') }}
                        </th>
                        <td>
                            {{ $userHealth->glucose }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userHealth.fields.user') }}
                        </th>
                        <td>
                            {{ $userHealth->user->user ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-healths.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#care_docs_user_docs" role="tab" data-toggle="tab">
                {{ trans('cruds.userDoc.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#carebies_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#care_med_medicines" role="tab" data-toggle="tab">
                {{ trans('cruds.medicine.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="care_docs_user_docs">
            @includeIf('admin.userHealths.relationships.careDocsUserDocs', ['userDocs' => $userHealth->careDocsUserDocs])
        </div>
        <div class="tab-pane" role="tabpanel" id="carebies_users">
            @includeIf('admin.userHealths.relationships.carebiesUsers', ['users' => $userHealth->carebiesUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="care_med_medicines">
            @includeIf('admin.userHealths.relationships.careMedMedicines', ['medicines' => $userHealth->careMedMedicines])
        </div>
    </div>
</div>

@endsection