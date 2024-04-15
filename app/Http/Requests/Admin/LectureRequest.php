<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LectureRequest extends FormRequest
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
            'tittle' => 'required|unique:lectures',
            'price'=>'required',
            'chapter_id'=>'required',
            'video_url'=>'',
            'des'=>'',
            'start'=>'',
            'end'=>'',
            'notes'=>'',

        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $chapter = $this->route()->parameter('chapter');
            $rules['tittle'] = 'required|unique:lectures,tittle,' . $chapter->id;
            $rules['price'] = 'required';
            $rules['chapter_id'] = '';
            $rules['video_url'] = '';
            $rules['des'] = '';
            $rules['end'] = '';
            $rules['start'] = '';
            //$rules['stage_id'] = 'required';
        }//end of if

        return $rules;

    }//end of rules
}//end of request
