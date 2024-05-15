<?php

namespace App\Http\Requests;

use App\Models\Counter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCounterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('counter_edit');
    }

    public function rules()
    {
        return [
            'bezeichnung' => [
                'string',
                'required',
            ],
            'key' => [
                'string',
                'required',
            ],
            'counter' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
