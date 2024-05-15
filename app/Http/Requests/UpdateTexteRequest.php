<?php

namespace App\Http\Requests;

use App\Models\Texte;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTexteRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('texte_edit');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'titel' => [
                'string',
                'nullable',
            ],
        ];
    }
}
