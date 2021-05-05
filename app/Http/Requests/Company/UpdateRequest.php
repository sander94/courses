<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'sometimes',
                'required',
                'string'
            ],
            'brand' => [
                'sometimes',
                'required',
                'string'
            ],
            'street' => [
                'sometimes',
                'required',
                'string'
            ],
            'city' => [
                'sometimes',
                'required',
                'string'
            ],
            'postal' => [
                'sometimes',
                'required',
                'string'
            ],
            'reg_number' => [
                'sometimes',
                'required',
                'string'
            ],
            'email' => [
                'sometimes',
                'required',
                'string',
                'email',
                Rule::unique('companies')->ignore($this->user()),
            ],
            'phone' => [
                'sometimes',
                'required',
                'string'
            ],
            'description' => [
                'sometimes',
                'required',
                'string'
            ],
            'region_id' => [
                'sometimes',
                'required',
                'exists:regions,id'
            ],

            'cover' => [
                'sometimes',
                'image'
            ]
        ];
    }
}
