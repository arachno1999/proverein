<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArtikelRequest;
use App\Http\Requests\StoreArtikelRequest;
use App\Http\Requests\UpdateArtikelRequest;
use App\Models\Artikel;
use App\Models\Submenu;
use App\Models\Team;
use App\Models\Template;
use App\Models\Webmenu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ArtikelController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('artikel_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artikels = Artikel::with(['menu', 'template', 'submenu', 'team', 'media'])->get();

        $webmenus = Webmenu::get();

        $templates = Template::get();

        $submenus = Submenu::get();

        $teams = Team::get();

        return view('admin.artikels.index', compact('artikels', 'submenus', 'teams', 'templates', 'webmenus'));
    }

    public function create()
    {
        abort_if(Gate::denies('artikel_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menus = Webmenu::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = Template::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submenus = Submenu::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.artikels.create', compact('menus', 'submenus', 'templates'));
    }

    public function store(StoreArtikelRequest $request)
    {
        $artikel = Artikel::create($request->all());

        foreach ($request->input('images', []) as $file) {
            $artikel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
        }

        foreach ($request->input('download', []) as $file) {
            $artikel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('download');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $artikel->id]);
        }

        return redirect()->route('admin.artikels.index');
    }

    public function edit(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menus = Webmenu::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $templates = Template::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submenus = Submenu::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $artikel->load('menu', 'template', 'submenu', 'team');

        return view('admin.artikels.edit', compact('artikel', 'menus', 'submenus', 'templates'));
    }

    public function update(UpdateArtikelRequest $request, Artikel $artikel)
    {
        $artikel->update($request->all());

        if (count($artikel->images) > 0) {
            foreach ($artikel->images as $media) {
                if (! in_array($media->file_name, $request->input('images', []))) {
                    $media->delete();
                }
            }
        }
        $media = $artikel->images->pluck('file_name')->toArray();
        foreach ($request->input('images', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $artikel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('images');
            }
        }

        if (count($artikel->download) > 0) {
            foreach ($artikel->download as $media) {
                if (! in_array($media->file_name, $request->input('download', []))) {
                    $media->delete();
                }
            }
        }
        $media = $artikel->download->pluck('file_name')->toArray();
        foreach ($request->input('download', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $artikel->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('download');
            }
        }

        return redirect()->route('admin.artikels.index');
    }

    public function show(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artikel->load('menu', 'template', 'submenu', 'team');

        return view('admin.artikels.show', compact('artikel'));
    }

    public function destroy(Artikel $artikel)
    {
        abort_if(Gate::denies('artikel_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artikel->delete();

        return back();
    }

    public function massDestroy(MassDestroyArtikelRequest $request)
    {
        $artikels = Artikel::find(request('ids'));

        foreach ($artikels as $artikel) {
            $artikel->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('artikel_create') && Gate::denies('artikel_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Artikel();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
