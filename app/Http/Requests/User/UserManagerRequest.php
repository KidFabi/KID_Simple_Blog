<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserManagerRequest extends FormRequest
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
        $userId = $this->user->id;

        return [
            'username' => ['required', 'string', 'min:3', 'max:60', "unique:users,username,{$userId}"],
            'first_name' => ['required', 'alpha', 'min:2', 'max:50'],
            'last_name' => ['required', 'alpha', 'min:2', 'max:50'],
            'role' => ['required', 'integer', 'in:1,2,3,4'],
        ];
    }
}
