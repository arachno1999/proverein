@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tag.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tags.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tag.fields.id') }}
                        </th>
                        <td>
                            {{ $tag->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tag.fields.bezeichnung') }}
                        </th>
                        <td>
                            {{ $tag->bezeichnung }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tag.fields.beschreibung') }}
                        </th>
                        <td>
                            {!! $tag->beschreibung !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.tags.index') }}">
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
            <a class="nav-link" href="#tag_vereins" role="tab" data-toggle="tab">
                {{ trans('cruds.verein.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tag_mitglieds" role="tab" data-toggle="tab">
                {{ trans('cruds.mitglied.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tags_webmenus" role="tab" data-toggle="tab">
                {{ trans('cruds.webmenu.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tag_howtos" role="tab" data-toggle="tab">
                {{ trans('cruds.howto.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="tag_vereins">
            @includeIf('admin.tags.relationships.tagVereins', ['vereins' => $tag->tagVereins])
        </div>
        <div class="tab-pane" role="tabpanel" id="tag_mitglieds">
            @includeIf('admin.tags.relationships.tagMitglieds', ['mitglieds' => $tag->tagMitglieds])
        </div>
        <div class="tab-pane" role="tabpanel" id="tags_webmenus">
            @includeIf('admin.tags.relationships.tagsWebmenus', ['webmenus' => $tag->tagsWebmenus])
        </div>
        <div class="tab-pane" role="tabpanel" id="tag_howtos">
            @includeIf('admin.tags.relationships.tagHowtos', ['howtos' => $tag->tagHowtos])
        </div>
    </div>
</div>

@endsection