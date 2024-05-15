<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyFaqNcRequest;
use App\Http\Requests\StoreFaqNcRequest;
use App\Http\Requests\UpdateFaqNcRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FaqNcController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('faq_nc_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faqNcs.index');
    }

    public function create()
    {
        abort_if(Gate::denies('faq_nc_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faqNcs.create');
    }

    public function store(StoreFaqNcRequest $request)
    {
        $faqNc = FaqNc::create($request->all());

        return redirect()->route('admin.faq-ncs.index');
    }

    public function edit(FaqNc $faqNc)
    {
        abort_if(Gate::denies('faq_nc_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faqNcs.edit', compact('faqNc'));
    }

    public function update(UpdateFaqNcRequest $request, FaqNc $faqNc)
    {
        $faqNc->update($request->all());

        return redirect()->route('admin.faq-ncs.index');
    }

    public function show(FaqNc $faqNc)
    {
        abort_if(Gate::denies('faq_nc_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.faqNcs.show', compact('faqNc'));
    }

    public function destroy(FaqNc $faqNc)
    {
        abort_if(Gate::denies('faq_nc_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $faqNc->delete();

        return back();
    }

    public function massDestroy(MassDestroyFaqNcRequest $request)
    {
        $faqNcs = FaqNc::find(request('ids'));

        foreach ($faqNcs as $faqNc) {
            $faqNc->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
