<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVeranstaltungRequest;
use App\Http\Requests\StoreVeranstaltungRequest;
use App\Http\Requests\UpdateVeranstaltungRequest;
use App\Models\Team;
use App\Models\Veranstaltung;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class VeranstaltungController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('veranstaltung_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $veranstaltungs = Veranstaltung::with(['team', 'media'])->get();

        $teams = Team::get();

        return view('admin.veranstaltungs.index', compact('teams', 'veranstaltungs'));
    }

    public function create()
    {
        abort_if(Gate::denies('veranstaltung_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.veranstaltungs.create');
    }

    public function store(StoreVeranstaltungRequest $request)
    {
        $veranstaltung = Veranstaltung::create($request->all());

        foreach ($request->input('image', []) as $file) {
            $veranstaltung->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $veranstaltung->id]);
        }

        return redirect()->route('admin.veranstaltungs.index');
    }

    public function edit(Veranstaltung $veranstaltung)
    {
        abort_if(Gate::denies('veranstaltung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $veranstaltung->load('team');

        return view('admin.veranstaltungs.edit', compact('veranstaltung'));
    }

    public function update(UpdateVeranstaltungRequest $request, Veranstaltung $veranstaltung)
    {
        $veranstaltung->update($request->all());

        if (count($veranstaltung->image) > 0) {
            foreach ($veranstaltung->image as $media) {
                if (! in_array($media->file_name, $request->input('image', []))) {
                    $media->delete();
                }
            }
        }
        $media = $veranstaltung->image->pluck('file_name')->toArray();
        foreach ($request->input('image', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $veranstaltung->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('image');
            }
        }

        return redirect()->route('admin.veranstaltungs.index');
    }

    public function show(Veranstaltung $veranstaltung)
    {
        abort_if(Gate::denies('veranstaltung_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $veranstaltung->load('team');

        return view('admin.veranstaltungs.show', compact('veranstaltung'));
    }

    public function destroy(Veranstaltung $veranstaltung)
    {
        abort_if(Gate::denies('veranstaltung_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $veranstaltung->delete();

        return back();
    }

    public function massDestroy(MassDestroyVeranstaltungRequest $request)
    {
        $veranstaltungs = Veranstaltung::find(request('ids'));

        foreach ($veranstaltungs as $veranstaltung) {
            $veranstaltung->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('veranstaltung_create') && Gate::denies('veranstaltung_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Veranstaltung();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
