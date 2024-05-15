<?php

namespace App\Http\Requests;

use App\Models\Aktion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyAktionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('aktion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:aktions,id',
        ];
    }
}
