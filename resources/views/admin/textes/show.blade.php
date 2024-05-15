@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.texte.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.textes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.texte.fields.id') }}
                        </th>
                        <td>
                            {{ $texte->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.texte.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $texte->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.texte.fields.titel') }}
                        </th>
                        <td>
                            {{ $texte->titel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.texte.fields.offiziell') }}
                        </th>
                        <td>
                            {!! $texte->offiziell !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.texte.fields.persoenlich') }}
                        </th>
                        <td>
                            {!! $texte->persoenlich !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.textes.index') }}">
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
            <a class="nav-link" href="#text_aktions" role="tab" data-toggle="tab">
                {{ trans('cruds.aktion.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="text_aktions">
            @includeIf('admin.textes.relationships.textAktions', ['aktions' => $texte->textAktions])
        </div>
    </div>
</div>

@endsection