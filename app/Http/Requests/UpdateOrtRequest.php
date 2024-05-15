<?php

namespace App\Http\Requests;

use App\Models\Ort;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateOrtRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ort_edit');
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
