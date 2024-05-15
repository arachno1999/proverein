<?php

namespace App\Http\Requests;

use App\Models\Webmenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWebmenuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('webmenu_edit');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'reihenfolge' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
            'template_id' => [
                'required',
                'integer',
            ],
            'slider' => [
                'array',
            ],
        ];
    }
}
