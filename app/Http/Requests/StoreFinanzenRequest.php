<?php

namespace App\Http\Requests;

use App\Models\Finanzen;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFinanzenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('finanzen_create');
    }

    public function rules()
    {
        return [
            'datum' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'bezeichnung' => [
                'string',
                'required',
            ],
            'betrag' => [
                'required',
            ],
            'kategorie_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
