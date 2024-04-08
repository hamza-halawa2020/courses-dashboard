<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StageRequest extends FormRequest
{
    /**
     * Determine if the Category is authorized to make this request.
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
        $rules = [
            'name' => 'required|unique:stages',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $stage = $this->route()->parameter('stage');
            $rules['name'] = 'required|unique:stages,id,' . $stage->id;
        }//end of if

        return $rules;

    }//end of rules
}//end of request
