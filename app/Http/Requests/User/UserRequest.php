<?php

namespace App\Http\Requests\User;

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
        $userId = auth()->user()->id;

        return [
            'email' => ['sometimes', 'required', 'string', 'email', 'max:190', "unique:users,email,{$userId}"],
            'username' => ['sometimes', 'required', 'string', 'min:3', 'max:60', "unique:users,username,{$userId}"],
            'first_name' => ['sometimes', 'required', 'alpha', 'min:2', 'max:50'],
            'last_name' => ['sometimes', 'required', 'alpha', 'min:2', 'max:50'],
            'birth_date' => ['sometimes', 'required', 'date', 'before:2015-12-31'],
            'avatar' => ['nullable', 'image', 'mimes:png,jpg,jpeg', 'max:2000', 'dimensions:width=140,height=140'],
            'notifications' => ['nullable', 'boolean'],
            'current_password' => ['sometimes', 'required', 'current_password'],
            'password' => ['sometimes', 'required', 'string', 'min:8', 'confirmed', 'different:current_password'],
        ];
    }
}
