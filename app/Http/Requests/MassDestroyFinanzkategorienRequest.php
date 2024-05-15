<?php

namespace App\Http\Requests;

use App\Models\Finanzkategorien;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyFinanzkategorienRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('finanzkategorien_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:finanzkategoriens,id',
        ];
    }
}
