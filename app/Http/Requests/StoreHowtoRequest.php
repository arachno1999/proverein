<?php

namespace App\Http\Requests;

use App\Models\Howto;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHowtoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('howto_create');
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
            'tags.*' => [
                'integer',
            ],
            'tags' => [
                'array',
            ],
        ];
    }
}
