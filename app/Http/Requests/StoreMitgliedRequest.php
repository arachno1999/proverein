<?php

namespace App\Http\Requests;

use App\Models\Mitglied;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMitgliedRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mitglied_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'birthday' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'type_id' => [
                'required',
                'integer',
            ],
            'anrede' => [
                'string',
                'required',
            ],
            'eintritt' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'austritt' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'organs.*' => [
                'integer',
            ],
            'organs' => [
                'array',
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
