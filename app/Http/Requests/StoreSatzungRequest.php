<?php

namespace App\Http\Requests;

use App\Models\Satzung;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSatzungRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('satzung_create');
    }

    public function rules()
    {
        return [
            'paragraph' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'titel' => [
                'string',
                'required',
            ],
        ];
    }
}
