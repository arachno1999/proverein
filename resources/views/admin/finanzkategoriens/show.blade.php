@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.finanzkategorien.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.finanzkategoriens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzkategorien.fields.id') }}
                        </th>
                        <td>
                            {{ $finanzkategorien->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzkategorien.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $finanzkategorien->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.finanzkategorien.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Finanzkategorien::TYPE_RADIO[$finanzkategorien->type] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.finanzkategoriens.index') }}">
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
            <a class="nav-link" href="#kategorie_finanzens" role="tab" data-toggle="tab">
                {{ trans('cruds.finanzen.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="kategorie_finanzens">
            @includeIf('admin.finanzkategoriens.relationships.kategorieFinanzens', ['finanzens' => $finanzkategorien->kategorieFinanzens])
        </div>
    </div>
</div>

@endsection