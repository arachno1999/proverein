<?php

namespace App\Http\Requests;

use App\Models\Webmenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWebmenuRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('webmenu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:webmenus,id',
        ];
    }
}
