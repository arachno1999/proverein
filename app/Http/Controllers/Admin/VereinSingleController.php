<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVereinSingleRequest;
use App\Http\Requests\StoreVereinSingleRequest;
use App\Http\Requests\UpdateVereinSingleRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VereinSingleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('verein_single_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vereinSingles.index');
    }

    public function create()
    {
        abort_if(Gate::denies('verein_single_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vereinSingles.create');
    }

    public function store(StoreVereinSingleRequest $request)
    {
        $vereinSingle = VereinSingle::create($request->all());

        return redirect()->route('admin.verein-singles.index');
    }

    public function edit(VereinSingle $vereinSingle)
    {
        abort_if(Gate::denies('verein_single_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vereinSingles.edit', compact('vereinSingle'));
    }

    public function update(UpdateVereinSingleRequest $request, VereinSingle $vereinSingle)
    {
        $vereinSingle->update($request->all());

        return redirect()->route('admin.verein-singles.index');
    }

    public function show(VereinSingle $vereinSingle)
    {
        abort_if(Gate::denies('verein_single_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.vereinSingles.show', compact('vereinSingle'));
    }

    public function destroy(VereinSingle $vereinSingle)
    {
        abort_if(Gate::denies('verein_single_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vereinSingle->delete();

        return back();
    }

    public function massDestroy(MassDestroyVereinSingleRequest $request)
    {
        $vereinSingles = VereinSingle::find(request('ids'));

        foreach ($vereinSingles as $vereinSingle) {
            $vereinSingle->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
