@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.webmenu.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.webmenus.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.id') }}
                        </th>
                        <td>
                            {{ $webmenu->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $webmenu->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.reihenfolge') }}
                        </th>
                        <td>
                            {{ $webmenu->reihenfolge }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.tags') }}
                        </th>
                        <td>
                            @foreach($webmenu->tags as $key => $tags)
                                <span class="label label-info">{{ $tags->bezeichnung }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.template') }}
                        </th>
                        <td>
                            {{ $webmenu->template->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.top_image') }}
                        </th>
                        <td>
                            @if($webmenu->top_image)
                                <a href="{{ $webmenu->top_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $webmenu->top_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.slider') }}
                        </th>
                        <td>
                            @foreach($webmenu->slider as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.webmenu.fields.footer') }}
                        </th>
                        <td>
                            @if($webmenu->footer)
                                <a href="{{ $webmenu->footer->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $webmenu->footer->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.webmenus.index') }}">
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
            <a class="nav-link" href="#menu_artikels" role="tab" data-toggle="tab">
                {{ trans('cruds.artikel.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#webmenu_submenus" role="tab" data-toggle="tab">
                {{ trans('cruds.submenu.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="menu_artikels">
            @includeIf('admin.webmenus.relationships.menuArtikels', ['artikels' => $webmenu->menuArtikels])
        </div>
        <div class="tab-pane" role="tabpanel" id="webmenu_submenus">
            @includeIf('admin.webmenus.relationships.webmenuSubmenus', ['submenus' => $webmenu->webmenuSubmenus])
        </div>
    </div>
</div>

@endsection