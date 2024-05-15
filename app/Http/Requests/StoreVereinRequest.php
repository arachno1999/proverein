<?php

namespace App\Http\Requests;

use App\Models\Verein;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreVereinRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('verein_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'beschreibung' => [
                'required',
            ],
            'gruendung' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'register' => [
                'string',
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