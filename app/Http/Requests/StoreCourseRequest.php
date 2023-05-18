<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email'
            ],
            'started_at' => [
                'sometimes',
                'required'
            ],
            'ended_at' => [
                'sometimes',
                'required'
            ],
            'price' => [
                'required',
            ],
            'url' => [
                'required',
                'url'
            ],
            'region_id' => [
                'required',
                'exists:regions,id'
            ],
            'categories' => [
                'required',
                'exists:course_categories,id'
            ],
            'course_type_id' => [
                'required',
            ]
        ];
    }
}
