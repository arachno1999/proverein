<div class="m-3">
    @can('finanzen_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.finanzens.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.finanzen.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.finanzen.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-kategorieFinanzens">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.finanzen.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.finanzen.fields.datum') }}
                            </th>
                            <th>
                                {{ trans('cruds.finanzen.fields.bezeichnung') }}
                            </th>
                            <th>
                                {{ trans('cruds.finanzen.fields.betrag') }}
                            </th>
                            <th>
                                {{ trans('cruds.finanzen.fields.kategorie') }}
                            </th>
                            <th>
                                {{ trans('cruds.finanzkategorien.fields.type') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finanzens as $key => $finanzen)
                            <tr data-entry-id="{{ $finanzen->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $finanzen->id ?? '' }}
                                </td>
                                <td>
                                    {{ $finanzen->datum ?? '' }}
                                </td>
                                <td>
                                    {{ $finanzen->bezeichnung ?? '' }}
                                </td>
                                <td>
                                    {{ $finanzen->betrag ?? '' }}
                                </td>
                                <td>
                                    {{ $finanzen->kategorie->bezeichnung ?? '' }}
                                </td>
                                <td>
                                    @if($finanzen->kategorie)
                                        {{ $finanzen->kategorie::TYPE_RADIO[$finanzen->kategorie->type] ?? '' }}
                                    @endif
                                </td>
                                <td>
                                    @can('finanzen_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.finanzens.show', $finanzen->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('finanzen_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.finanzens.edit', $finanzen->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('finanzen_delete')
                                        <form action="{{ route('admin.finanzens.destroy', $finanzen->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('finanzen_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.finanzens.massDestroy') }}",
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
    order: [[ 2, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-kategorieFinanzens:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection