<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyHowtoNcRequest;
use App\Http\Requests\StoreHowtoNcRequest;
use App\Http\Requests\UpdateHowtoNcRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HowtoNcController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('howto_nc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.howtoNcs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('howto_nc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.howtoNcs.create');
    }

    public function store(StoreHowtoNcRequest $request)
    {
        $howtoNc = HowtoNc::create($request->all());

        return redirect()->route('admin.howto-ncs.index');
    }

    public function edit(HowtoNc $howtoNc)
    {
        abort_if(Gate::denies('howto_nc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.howtoNcs.edit', compact('howtoNc'));
    }

    public function update(UpdateHowtoNcRequest $request, HowtoNc $howtoNc)
    {
        $howtoNc->update($request->all());

        return redirect()->route('admin.howto-ncs.index');
    }

    public function show(HowtoNc $howtoNc)
    {
        abort_if(Gate::denies('howto_nc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.howtoNcs.show', compact('howtoNc'));
    }

    public function destroy(HowtoNc $howtoNc)
    {
        abort_if(Gate::denies('howto_nc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $howtoNc->delete();

        return back();
    }

    public function massDestroy(MassDestroyHowtoNcRequest $request)
    {
        $howtoNcs = HowtoNc::find(request('ids'));

        foreach ($howtoNcs as $howtoNc) {
            $howtoNc->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
