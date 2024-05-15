<?php

namespace App\Http\Requests;

use App\Models\Submenu;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSubmenuRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('submenu_create');
    }

    public function rules()
    {
        return [
            'webmenu_id' => [
                'required',
                'integer',
            ],
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
        ];
    }
}
