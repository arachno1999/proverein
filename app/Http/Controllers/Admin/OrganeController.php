<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyOrganeRequest;
use App\Http\Requests\StoreOrganeRequest;
use App\Http\Requests\UpdateOrganeRequest;
use App\Models\Organe;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrganeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('organe_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organes = Organe::with(['team'])->get();

        $teams = Team::get();

        return view('admin.organes.index', compact('organes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('organe_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organes.create');
    }

    public function store(StoreOrganeRequest $request)
    {
        $organe = Organe::create($request->all());

        return redirect()->route('admin.organes.index');
    }

    public function edit(Organe $organe)
    {
        abort_if(Gate::denies('organe_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organe->load('team');

        return view('admin.organes.edit', compact('organe'));
    }

    public function update(UpdateOrganeRequest $request, Organe $organe)
    {
        $organe->update($request->all());

        return redirect()->route('admin.organes.index');
    }

    public function show(Organe $organe)
    {
        abort_if(Gate::denies('organe_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organe->load('team', 'targetAktions', 'organMitglieds');

        return view('admin.organes.show', compact('organe'));
    }

    public function destroy(Organe $organe)
    {
        abort_if(Gate::denies('organe_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organe->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganeRequest $request)
    {
        $organes = Organe::find(request('ids'));

        foreach ($organes as $organe) {
            $organe->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
