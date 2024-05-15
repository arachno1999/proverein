<?php

namespace App\Http\Requests;

use App\Models\Finanzkategorien;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFinanzkategorienRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('finanzkategorien_edit');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'type' => [
                'required',
            ],
        ];
    }
}
