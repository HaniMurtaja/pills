@extends('layouts.admin')
@section('content')
@can('user_health_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-healths.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userHealth.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'UserHealth', 'route' => 'admin.user-healths.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.userHealth.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-UserHealth">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.careby_id') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.gender') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.dob') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.blood_pressure') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.blood_group') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.height') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.weight') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.bmi') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.total_cholestrol') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.ldl_cholestrol') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.hdl_cholestrol') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.triglycerides') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.glucose') }}
                    </th>
                    <th>
                        {{ trans('cruds.userHealth.fields.user') }}
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_health_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-healths.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.user-healths.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'careby_id', name: 'careby_id' },
{ data: 'name', name: 'name' },
{ data: 'gender', name: 'gender' },
{ data: 'dob', name: 'dob' },
{ data: 'blood_pressure', name: 'blood_pressure' },
{ data: 'blood_group', name: 'blood_group' },
{ data: 'height', name: 'height' },
{ data: 'weight', name: 'weight' },
{ data: 'bmi', name: 'bmi' },
{ data: 'total_cholestrol', name: 'total_cholestrol' },
{ data: 'ldl_cholestrol', name: 'ldl_cholestrol' },
{ data: 'hdl_cholestrol', name: 'hdl_cholestrol' },
{ data: 'triglycerides', name: 'triglycerides' },
{ data: 'glucose', name: 'glucose' },
{ data: 'user_user', name: 'user.user' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-UserHealth').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection