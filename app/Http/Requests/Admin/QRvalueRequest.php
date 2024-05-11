<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class QRvalueRequest extends FormRequest
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
            'title' => 'required|unique:q_rvalues',
            'value' => 'required'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $qRvalue = $this->route()->parameter('qRvalue');
            $rules['title'] = 'required|unique:q_rvalues,id,' . $qRvalue->id;
            $rules['value'] = 'required';
        }//end of if

        return $rules;

    }//end of rules
}//end of request
