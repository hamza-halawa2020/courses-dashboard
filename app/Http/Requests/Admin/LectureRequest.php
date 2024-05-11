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
            'method' => '',
            'status' => '',
            'userIDStatus' => '',
            'statusValue' => '',
            'title' => 'required|unique:lectures',
            'price' => 'required',
            'chapter_id' => 'required',
            'video_url' => '',
            'note_book_url' => '',
            'des' => '',
            'start' => '',
            'end' => '',
            'notes' => '',

        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $lec = $this->route()->parameter('lecture');
            $rules['title'] = 'unique:lectures,title,' . $lec->id;
            $rules['price'] = '';
            $rules['chapter_id'] = '';
            $rules['video_url'] = '';
            $rules['des'] = '';
            $rules['end'] = '';
            $rules['start'] = '';
        }//end of if

        return $rules;

    }//end of rules
}//end of request
