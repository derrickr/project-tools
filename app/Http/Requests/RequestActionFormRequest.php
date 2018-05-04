<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestActionFormRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        //return [];
        if (request()->route()->parameter('action') == 'analysed') {
            return ["req_type" => 'required',
                "soln" => 'required',
                "skills" => 'required',
                "approach" => 'required',
                "backout_method" => 'required'
            ];
        }
        if (request()->route()->parameter('action') == 'scheduled') {
            return ["planned_start" => 'required',
                "planned_finish" => 'required'
            ];
        }
        if (request()->route()->parameter('action') == 'update') {
            return [
                "title" => 'required',
                "description" => 'required',
                "justification" => 'required',
                "deliverables" => 'required',
                "criteria" => 'required',
                "required_date" => 'required',
            ];
        }
        if (request()->route()->parameter('action') == 'pass' || request()->route()->parameter('action')== 'fail') {
            return [
                "testresults" => 'required'
            ];
        }
        return [];
    }

}
