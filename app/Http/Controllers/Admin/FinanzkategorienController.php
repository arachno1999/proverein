<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFinanzkategorienRequest;
use App\Http\Requests\StoreFinanzkategorienRequest;
use App\Http\Requests\UpdateFinanzkategorienRequest;
use App\Models\Finanzkategorien;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FinanzkategorienController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('finanzkategorien_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finanzkategoriens = Finanzkategorien::with(['team'])->get();

        $teams = Team::get();

        return view('admin.finanzkategoriens.index', compact('finanzkategoriens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('finanzkategorien_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.finanzkategoriens.create');
    }

    public function store(StoreFinanzkategorienRequest $request)
    {
        $finanzkategorien = Finanzkategorien::create($request->all());

        return redirect()->route('admin.finanzkategoriens.index');
    }

    public function edit(Finanzkategorien $finanzkategorien)
    {
        abort_if(Gate::denies('finanzkategorien_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finanzkategorien->load('team');

        return view('admin.finanzkategoriens.edit', compact('finanzkategorien'));
    }

    public function update(UpdateFinanzkategorienRequest $request, Finanzkategorien $finanzkategorien)
    {
        $finanzkategorien->update($request->all());

        return redirect()->route('admin.finanzkategoriens.index');
    }

    public function show(Finanzkategorien $finanzkategorien)
    {
        abort_if(Gate::denies('finanzkategorien_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finanzkategorien->load('team', 'kategorieFinanzens');

        return view('admin.finanzkategoriens.show', compact('finanzkategorien'));
    }

    public function destroy(Finanzkategorien $finanzkategorien)
    {
        abort_if(Gate::denies('finanzkategorien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $finanzkategorien->delete();

        return back();
    }

    public function massDestroy(MassDestroyFinanzkategorienRequest $request)
    {
        $finanzkategoriens = Finanzkategorien::find(request('ids'));

        foreach ($finanzkategoriens as $finanzkategorien) {
            $finanzkategorien->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
