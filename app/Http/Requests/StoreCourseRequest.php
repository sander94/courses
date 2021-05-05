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
            'phone' => [
                'required',
                'string'
            ],
            'email' => [
                'required',
                'email'
            ],
            'started_at' => [
                'required',
            ],
            'ended_at' => [
                'required',
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
            'course_category_id' => [
                'required',
                'exists:course_categories,id'
            ],
        ];
    }
}
