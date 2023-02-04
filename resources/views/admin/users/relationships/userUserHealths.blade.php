@can('user_health_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.user-healths.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.userHealth.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userHealth.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userUserHealths">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userHealth.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.userHealth.fields.careby') }}
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
                <tbody>
                    @foreach($userHealths as $key => $userHealth)
                        <tr data-entry-id="{{ $userHealth->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userHealth->id ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->careby ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->name ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\UserHealth::GENDER_SELECT[$userHealth->gender] ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->dob ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->blood_pressure ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->blood_group ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->height ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->weight ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->bmi ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->total_cholestrol ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->ldl_cholestrol ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->hdl_cholestrol ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->triglycerides ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->glucose ?? '' }}
                            </td>
                            <td>
                                {{ $userHealth->user->user ?? '' }}
                            </td>
                            <td>
                                @can('user_health_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.user-healths.show', $userHealth->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_health_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.user-healths.edit', $userHealth->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_health_delete')
                                    <form action="{{ route('admin.user-healths.destroy', $userHealth->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_health_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.user-healths.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userUserHealths:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection