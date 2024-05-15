<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrtRequest;
use App\Http\Requests\StoreOrtRequest;
use App\Http\Requests\UpdateOrtRequest;
use App\Models\Ort;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OrtController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('ort_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $orts = Ort::with(['team'])->get();

        $teams = Team::get();

        return view('admin.orts.index', compact('orts', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('ort_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.orts.create');
    }

    public function store(StoreOrtRequest $request)
    {
        $ort = Ort::create($request->all());

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $ort->id]);
        }

        return redirect()->route('admin.orts.index');
    }

    public function edit(Ort $ort)
    {
        abort_if(Gate::denies('ort_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ort->load('team');

        return view('admin.orts.edit', compact('ort'));
    }

    public function update(UpdateOrtRequest $request, Ort $ort)
    {
        $ort->update($request->all());

        return redirect()->route('admin.orts.index');
    }

    public function show(Ort $ort)
    {
        abort_if(Gate::denies('ort_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ort->load('team', 'ortAktions');

        return view('admin.orts.show', compact('ort'));
    }

    public function destroy(Ort $ort)
    {
        abort_if(Gate::denies('ort_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ort->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrtRequest $request)
    {
        $orts = Ort::find(request('ids'));

        foreach ($orts as $ort) {
            $ort->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('ort_create') && Gate::denies('ort_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Ort();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
