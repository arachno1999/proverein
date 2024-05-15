<?php

namespace App\Http\Requests;

use App\Models\Finanzen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFinanzenRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('finanzen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:finanzens,id',
        ];
    }
}
