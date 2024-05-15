<div class="m-3">
    @can('submenu_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.submenus.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.submenu.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.submenu.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-webmenuSubmenus">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.submenu.fields.webmenu') }}
                            </th>
                            <th>
                                {{ trans('cruds.submenu.fields.bezeichnung') }}
                            </th>
                            <th>
                                {{ trans('cruds.submenu.fields.reihenfolge') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submenus as $key => $submenu)
                            <tr data-entry-id="{{ $submenu->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $submenu->webmenu->bezeichnung ?? '' }}
                                </td>
                                <td>
                                    {{ $submenu->bezeichnung ?? '' }}
                                </td>
                                <td>
                                    {{ $submenu->reihenfolge ?? '' }}
                                </td>
                                <td>
                                    @can('submenu_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.submenus.show', $submenu->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('submenu_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.submenus.edit', $submenu->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('submenu_delete')
                                        <form action="{{ route('admin.submenus.destroy', $submenu->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('submenu_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.submenus.massDestroy') }}",
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
    order: [[ 2, 'asc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-webmenuSubmenus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection