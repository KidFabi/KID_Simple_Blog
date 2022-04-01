<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
        return [
            'title' => ['required', 'min:10', 'max:70'],
            'subhead' => ['required', 'min:50', 'max:500'],
            'visibility' => ['required', 'in:Draft,Awaiting Approval'],
            'content' => ['required', 'min:500', 'max:10000'],
            'cover' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2000', 'dimensions:width=900,height=400'],
            'categories' => ['required'],
            'categories.*' => ['exists:categories,id'],
        ];
    }
}
