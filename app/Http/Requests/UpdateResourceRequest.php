<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateResourceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resource'=>'required|unique:resources,resource,'.request()->get('id'),
            'abbrv'=>'required|unique:resources,abbrv,'.request()->get('id'),
            'price'=>'required'
        ];

    }
}
