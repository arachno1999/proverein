@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.ort.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orts.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.ort.fields.id') }}
                        </th>
                        <td>
                            {{ $ort->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ort.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $ort->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ort.fields.beschreibung') }}
                        </th>
                        <td>
                            {!! $ort->beschreibung !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.ort.fields.maps') }}
                        </th>
                        <td>
                            {{ $ort->maps }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.orts.index') }}">
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
            <a class="nav-link" href="#ort_aktions" role="tab" data-toggle="tab">
                {{ trans('cruds.aktion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="ort_aktions">
            @includeIf('admin.orts.relationships.ortAktions', ['aktions' => $ort->ortAktions])
        </div>
    </div>
</div>

@endsection