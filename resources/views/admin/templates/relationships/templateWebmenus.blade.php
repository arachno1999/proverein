<div class="m-3">
    @can('webmenu_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.webmenus.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.webmenu.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.webmenu.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-templateWebmenus">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.webmenu.fields.bezeichnung') }}
                            </th>
                            <th>
                                {{ trans('cruds.webmenu.fields.reihenfolge') }}
                            </th>
                            <th>
                                {{ trans('cruds.webmenu.fields.tags') }}
                            </th>
                            <th>
                                {{ trans('cruds.webmenu.fields.template') }}
                            </th>
                            <th>
                                {{ trans('cruds.webmenu.fields.top_image') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($webmenus as $key => $webmenu)
                            <tr data-entry-id="{{ $webmenu->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $webmenu->bezeichnung ?? '' }}
                                </td>
                                <td>
                                    {{ $webmenu->reihenfolge ?? '' }}
                                </td>
                                <td>
                                    @foreach($webmenu->tags as $key => $item)
                                        <span class="badge badge-info">{{ $item->bezeichnung }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $webmenu->template->name ?? '' }}
                                </td>
                                <td>
                                    @if($webmenu->top_image)
                                        <a href="{{ $webmenu->top_image->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $webmenu->top_image->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @can('webmenu_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.webmenus.show', $webmenu->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('webmenu_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.webmenus.edit', $webmenu->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('webmenu_delete')
                                        <form action="{{ route('admin.webmenus.destroy', $webmenu->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('webmenu_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.webmenus.massDestroy') }}",
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
  let table = $('.datatable-templateWebmenus:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection