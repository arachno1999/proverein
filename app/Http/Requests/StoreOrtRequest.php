<?php

namespace App\Http\Requests;

use App\Models\Ort;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreOrtRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ort_create');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'beschreibung' => [
                'required',
            ],
            'maps' => [
                'string',
                'nullable',
            ],
        ];
    }
}
