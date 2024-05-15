<?php

namespace App\Http\Requests;

use App\Models\MitgliedsTyp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMitgliedsTypRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('mitglieds_typ_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:mitglieds_typs,id',
        ];
    }
}
