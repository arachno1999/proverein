@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.organe.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.organe.fields.id') }}
                        </th>
                        <td>
                            {{ $organe->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organe.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $organe->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organe.fields.reihenfolge') }}
                        </th>
                        <td>
                            {{ $organe->reihenfolge }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organes.index') }}">
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
            <a class="nav-link" href="#target_aktions" role="tab" data-toggle="tab">
                {{ trans('cruds.aktion.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#organ_mitglieds" role="tab" data-toggle="tab">
                {{ trans('cruds.mitglied.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="target_aktions">
            @includeIf('admin.organes.relationships.targetAktions', ['aktions' => $organe->targetAktions])
        </div>
        <div class="tab-pane" role="tabpanel" id="organ_mitglieds">
            @includeIf('admin.organes.relationships.organMitglieds', ['mitglieds' => $organe->organMitglieds])
        </div>
    </div>
</div>

@endsection