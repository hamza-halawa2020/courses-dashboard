<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            // student attribute
            'name' => 'required',
            'phone' => 'required|unique:users,phone|max:11|min:11',
            'email' => 'nullable|unique:users,email|email',
            'password' => 'required|confirmed',
            'type' => 'required',
            'gender'=>'required',
            'stage_id'=>'required',
            'place_id'=>'required',
            'balance'=>'',
            // parent attribute
            'parent_name'=>'',
            'parent_phone'=>'unique:users,parent_phone'
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $user = $this->route()->parameter('user');

            $rules['email'] = 'nullable|email|unique:users,email,' . $user->id;
            $rules['phone'] = 'required|max:11|min:11|unique:users,phone,' . $user->id;
            $rules['parent_phone'] = 'max:11|min:11|unique:users,parent_phone,' . $user->id;
            $rules['password'] = '';
            $rules['parent_name'] = '';


        }//end of if

        return $rules;

    }//end of rules

    protected function prepareForValidation()
    {
        return $this->merge([
            'type' => 'user'
        ]);

    }//end of prepare for validation

}//end of request
