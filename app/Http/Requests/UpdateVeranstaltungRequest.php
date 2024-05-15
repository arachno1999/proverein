<?php

namespace App\Http\Requests;

use App\Models\Veranstaltung;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateVeranstaltungRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('veranstaltung_edit');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'from' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'to' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'beschreibung' => [
                'required',
            ],
            'image' => [
                'array',
            ],
        ];
    }
}
