<?php

namespace App\Http\Requests;

use App\Models\MitgliedsTyp;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMitgliedsTypRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('mitglieds_typ_edit');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'jahresbeitrag' => [
                'required',
            ],
            'beschreibung' => [
                'required',
            ],
        ];
    }
}
