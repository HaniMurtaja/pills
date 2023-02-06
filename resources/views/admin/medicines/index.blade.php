@extends('layouts.admin')
@section('content')
@can('medicine_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.medicines.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.medicine.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Medicine', 'route' => 'admin.medicines.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.medicine.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Medicine">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.medicine.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.medicine.fields.med_generic_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.medicine.fields.med_scientific_name') }}
                    </th>
                    <th>
                        {{ trans('cruds.medicine.fields.med_quantity') }}
                    </th>
                    <th>
                        {{ trans('cruds.medicine.fields.med_expire_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.medicine.fields.user_med') }}
                    </th>
                    <th>
                        {{ trans('cruds.medicine.fields.care_med') }}
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
@can('medicine_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.medicines.massDestroy') }}",
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
    ajax: "{{ route('admin.medicines.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'med_generic_name', name: 'med_generic_name' },
{ data: 'med_scientific_name', name: 'med_scientific_name' },
{ data: 'med_quantity', name: 'med_quantity' },
{ data: 'med_expire_date', name: 'med_expire_date' },
{ data: 'user_med_user', name: 'user_med_user' },
{ data: 'care_med', name: 'care_meds.careby' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Medicine').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
});

</script>
@endsection