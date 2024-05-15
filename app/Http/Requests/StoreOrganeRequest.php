<?php

namespace App\Http\Requests;

use App\Models\Organe;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrganeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('organe_create');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
                'unique:organes',
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
