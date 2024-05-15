<?php

namespace App\Http\Requests;

use App\Models\Howto;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHowtoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('howto_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:howtos,id',
        ];
    }
}
