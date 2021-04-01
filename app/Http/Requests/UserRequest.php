<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends ApiValidator
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'role_id'   =>  'required',
            'firstname' =>  'required',
            'surname'   =>  'required',
            'login'     =>  'required|unique:users',
            'email',
            'password'  =>  'required',
        ];
    }
}
