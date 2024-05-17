<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'title' => 'required|unique:courses',
            'stage_id' => 'required',
            'teacher_id' => 'required',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $course = $this->route()->parameter('course');
            $rules['title'] = 'required|unique:courses,title,' . $course->id;
            $rules['stage_id'] = 'required';
            $rules['teacher_id'] = 'required';
        }//end of if

        return $rules;

    }//end of rules
}//end of request
