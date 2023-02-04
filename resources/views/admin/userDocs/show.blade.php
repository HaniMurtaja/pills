@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userDoc.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-docs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userDoc.fields.id') }}
                        </th>
                        <td>
                            {{ $userDoc->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDoc.fields.date') }}
                        </th>
                        <td>
                            {{ $userDoc->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDoc.fields.description') }}
                        </th>
                        <td>
                            {{ $userDoc->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDoc.fields.file') }}
                        </th>
                        <td>
                            @if($userDoc->file)
                                <a href="{{ $userDoc->file->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDoc.fields.care_docs') }}
                        </th>
                        <td>
                            @foreach($userDoc->care_docs as $key => $care_docs)
                                <span class="label label-info">{{ $care_docs->careby }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userDoc.fields.user_doc') }}
                        </th>
                        <td>
                            {{ $userDoc->user_doc->user ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-docs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection