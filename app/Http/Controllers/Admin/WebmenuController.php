<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyWebmenuRequest;
use App\Http\Requests\StoreWebmenuRequest;
use App\Http\Requests\UpdateWebmenuRequest;
use App\Models\Tag;
use App\Models\Team;
use App\Models\Template;
use App\Models\Webmenu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class WebmenuController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('webmenu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webmenus = Webmenu::with(['tags', 'template', 'team', 'media'])->get();

        $tags = Tag::get();

        $templates = Template::get();

        $teams = Team::get();

        return view('admin.webmenus.index', compact('tags', 'teams', 'templates', 'webmenus'));
    }

    public function create()
    {
        abort_if(Gate::denies('webmenu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('bezeichnung', 'id');

        $templates = Template::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.webmenus.create', compact('tags', 'templates'));
    }

    public function store(StoreWebmenuRequest $request)
    {
        $webmenu = Webmenu::create($request->all());
        $webmenu->tags()->sync($request->input('tags', []));
        if ($request->input('top_image', false)) {
            $webmenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('top_image'))))->toMediaCollection('top_image');
        }

        foreach ($request->input('slider', []) as $file) {
            $webmenu->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('slider');
        }

        if ($request->input('footer', false)) {
            $webmenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('footer'))))->toMediaCollection('footer');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $webmenu->id]);
        }

        return redirect()->route('admin.webmenus.index');
    }

    public function edit(Webmenu $webmenu)
    {
        abort_if(Gate::denies('webmenu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tags = Tag::pluck('bezeichnung', 'id');

        $templates = Template::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $webmenu->load('tags', 'template', 'team');

        return view('admin.webmenus.edit', compact('tags', 'templates', 'webmenu'));
    }

    public function update(UpdateWebmenuRequest $request, Webmenu $webmenu)
    {
        $webmenu->update($request->all());
        $webmenu->tags()->sync($request->input('tags', []));
        if ($request->input('top_image', false)) {
            if (! $webmenu->top_image || $request->input('top_image') !== $webmenu->top_image->file_name) {
                if ($webmenu->top_image) {
                    $webmenu->top_image->delete();
                }
                $webmenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('top_image'))))->toMediaCollection('top_image');
            }
        } elseif ($webmenu->top_image) {
            $webmenu->top_image->delete();
        }

        if (count($webmenu->slider) > 0) {
            foreach ($webmenu->slider as $media) {
                if (! in_array($media->file_name, $request->input('slider', []))) {
                    $media->delete();
                }
            }
        }
        $media = $webmenu->slider->pluck('file_name')->toArray();
        foreach ($request->input('slider', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $webmenu->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('slider');
            }
        }

        if ($request->input('footer', false)) {
            if (! $webmenu->footer || $request->input('footer') !== $webmenu->footer->file_name) {
                if ($webmenu->footer) {
                    $webmenu->footer->delete();
                }
                $webmenu->addMedia(storage_path('tmp/uploads/' . basename($request->input('footer'))))->toMediaCollection('footer');
            }
        } elseif ($webmenu->footer) {
            $webmenu->footer->delete();
        }

        return redirect()->route('admin.webmenus.index');
    }

    public function show(Webmenu $webmenu)
    {
        abort_if(Gate::denies('webmenu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webmenu->load('tags', 'template', 'team', 'menuArtikels', 'webmenuSubmenus');

        return view('admin.webmenus.show', compact('webmenu'));
    }

    public function destroy(Webmenu $webmenu)
    {
        abort_if(Gate::denies('webmenu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webmenu->delete();

        return back();
    }

    public function massDestroy(MassDestroyWebmenuRequest $request)
    {
        $webmenus = Webmenu::find(request('ids'));

        foreach ($webmenus as $webmenu) {
            $webmenu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('webmenu_create') && Gate::denies('webmenu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Webmenu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
