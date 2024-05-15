<?php

namespace App\Http\Requests;

use App\Models\Aktion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAktionRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('aktion_edit');
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
            'start' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'targets.*' => [
                'integer',
            ],
            'targets' => [
                'required',
                'array',
            ],
        ];
    }
}
