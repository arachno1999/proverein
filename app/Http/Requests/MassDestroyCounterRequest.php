<?php

namespace App\Http\Requests;

use App\Models\Counter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCounterRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('counter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:counters,id',
        ];
    }
}
