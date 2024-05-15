@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.submenu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.submenus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.submenu.fields.id') }}
                        </th>
                        <td>
                            {{ $submenu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submenu.fields.webmenu') }}
                        </th>
                        <td>
                            {{ $submenu->webmenu->bezeichnung ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submenu.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $submenu->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submenu.fields.reihenfolge') }}
                        </th>
                        <td>
                            {{ $submenu->reihenfolge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.submenu.fields.beschreibung') }}
                        </th>
                        <td>
                            {!! $submenu->beschreibung !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.submenus.index') }}">
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
            <a class="nav-link" href="#submenu_artikels" role="tab" data-toggle="tab">
                {{ trans('cruds.artikel.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="submenu_artikels">
            @includeIf('admin.submenus.relationships.submenuArtikels', ['artikels' => $submenu->submenuArtikels])
        </div>
    </div>
</div>

@endsection