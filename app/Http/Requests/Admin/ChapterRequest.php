<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
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
            'tittle' => 'required|unique:chapters',
            'price'=>'required',
            'course_id'=>'required',
            //'stage_id' => 'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $chapter = $this->route()->parameter('chapter');    
            $rules['tittle'] = 'required|unique:chapters,tittle,' . $chapter->id;
            $rules['price'] = 'required';
            $rules['course_id'] = '';
            //$rules['stage_id'] = 'required';
        }//end of if

        return $rules;

    }//end of rules
}//end of request
