@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.template.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.id') }}
                        </th>
                        <td>
                            {{ $template->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.name') }}
                        </th>
                        <td>
                            {{ $template->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.content') }}
                        </th>
                        <td>
                            {{ $template->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.code_mobile') }}
                        </th>
                        <td>
                            {{ $template->code_mobile }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
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
            <a class="nav-link" href="#template_webmenus" role="tab" data-toggle="tab">
                {{ trans('cruds.webmenu.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#template_artikels" role="tab" data-toggle="tab">
                {{ trans('cruds.artikel.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="template_webmenus">
            @includeIf('admin.templates.relationships.templateWebmenus', ['webmenus' => $template->templateWebmenus])
        </div>
        <div class="tab-pane" role="tabpanel" id="template_artikels">
            @includeIf('admin.templates.relationships.templateArtikels', ['artikels' => $template->templateArtikels])
        </div>
    </div>
</div>

@endsection