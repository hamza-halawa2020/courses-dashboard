<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
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
            'method' => '',
            'status' => '',
            'userIDStatus' => '',
            'statusValue' => '',
            'password' => '',
            'userIDPassword' => '',
            'balance'=>'',
            'userIDBalance' => '',
            'device'=>'',
            'userIDDevice' => '',
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {

            $user = $this->route()->parameter('user');
            $rules['method'] = '';
            $rules['status'] = '';
            $rules['userIDStatus'] = '';
            $rules['statusValue'] = '';
            $rules['password'] = '';
            $rules['userIDPassword'] = '';
            $rules['balance']='';
            $rules['userIDBalance'] = '';
            $rules['device']='';
            $rules['userIDDevice'] = '';


        }//end of if

        return $rules;

    }//end of rules


}//end of request
