<?php

namespace App\Http\Requests;

use App\Models\Image;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateImageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('image_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:images,name,' . request()->route('image')->id,
            ],
            'attachments' => [
                'array',
            ],
            'class' => [
                'string',
                'nullable',
            ],
        ];
    }
}
