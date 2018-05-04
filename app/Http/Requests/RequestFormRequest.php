<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFormRequest extends FormRequest
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
    public function rules() {
        //return [];
        return [
            "title" => 'sometimes|required',
            "description" => 'sometimes|required',
            "justification" => 'sometimes|required',
            "deliverables" => 'sometimes|required',
            "criteria" => 'sometimes|required',
            "required_date" => 'sometimes|required',
            "fasttrack_comment" => 'sometimes|required_if:fasttrack,active',
//            "cancelled_comment" => 'required_if:action,cancel',
//            "updated_comment" => 'required_if:action,update',
//            "more_info_comment" => 'required_if:action,more-info',
//            "rejected_comment" => 'required_if:action,reject',
        ];
    }
}
