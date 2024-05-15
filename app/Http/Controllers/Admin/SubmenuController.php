<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySubmenuRequest;
use App\Http\Requests\StoreSubmenuRequest;
use App\Http\Requests\UpdateSubmenuRequest;
use App\Models\Submenu;
use App\Models\Team;
use App\Models\Webmenu;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SubmenuController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('submenu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submenus = Submenu::with(['webmenu', 'team'])->get();

        $webmenus = Webmenu::get();

        $teams = Team::get();

        return view('admin.submenus.index', compact('submenus', 'teams', 'webmenus'));
    }

    public function create()
    {
        abort_if(Gate::denies('submenu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webmenus = Webmenu::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.submenus.create', compact('webmenus'));
    }

    public function store(StoreSubmenuRequest $request)
    {
        $submenu = Submenu::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $submenu->id]);
        }

        return redirect()->route('admin.submenus.index');
    }

    public function edit(Submenu $submenu)
    {
        abort_if(Gate::denies('submenu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $webmenus = Webmenu::pluck('bezeichnung', 'id')->prepend(trans('global.pleaseSelect'), '');

        $submenu->load('webmenu', 'team');

        return view('admin.submenus.edit', compact('submenu', 'webmenus'));
    }

    public function update(UpdateSubmenuRequest $request, Submenu $submenu)
    {
        $submenu->update($request->all());

        return redirect()->route('admin.submenus.index');
    }

    public function show(Submenu $submenu)
    {
        abort_if(Gate::denies('submenu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submenu->load('webmenu', 'team', 'submenuArtikels');

        return view('admin.submenus.show', compact('submenu'));
    }

    public function destroy(Submenu $submenu)
    {
        abort_if(Gate::denies('submenu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $submenu->delete();

        return back();
    }

    public function massDestroy(MassDestroySubmenuRequest $request)
    {
        $submenus = Submenu::find(request('ids'));

        foreach ($submenus as $submenu) {
            $submenu->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('submenu_create') && Gate::denies('submenu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Submenu();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
