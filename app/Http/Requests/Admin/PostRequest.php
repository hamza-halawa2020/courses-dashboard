<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'body' => 'required',
            'phone' => 'required|regex:/(01)[0-9]{9}/|max:11,min:11'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $post = $this->route()->parameter('post');
            $rules['body'] = 'required';
            $rules['phone'] = 'required|regex:/(01)[0-9]{9}/|max:11,min:11';

        }//end of if

        return $rules;

    }//end of rules
}//end of request
