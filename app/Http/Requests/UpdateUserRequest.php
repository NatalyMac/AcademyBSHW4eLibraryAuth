<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = $this->route('users');
           return ($user_id == \Auth::id() or \Auth::user()->role == 'admin');
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
                  'email'     => 'required'];
        return $rules;
    }
}
