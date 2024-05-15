<?php

namespace App\Http\Requests;

use App\Models\Artikel;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreArtikelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('artikel_create');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'menu_id' => [
                'required',
                'integer',
            ],
            'sichtbar' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'end' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'fulltext' => [
                'required',
            ],
            'images' => [
                'array',
            ],
            'download' => [
                'array',
            ],
            'position' => [
                'required',
            ],
            'reihenfolge' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'template_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
