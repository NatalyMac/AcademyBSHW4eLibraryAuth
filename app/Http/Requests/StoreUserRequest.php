<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (\Auth::user()->role == 'admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['firstname' => 'required|alpha',
            'lastname'  => 'required|alpha',
            'email'     => 'required|email|unique:users',
            'password'  => 'required',
            'role'      => 'required'];

        return $rules;
    }
}
