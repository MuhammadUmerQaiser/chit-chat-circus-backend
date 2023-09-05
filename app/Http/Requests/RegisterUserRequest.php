<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'required|unique:users',
            'password'      => 'required|min:8|confirmed',
            'user_image_id' => 'required|exists:user_images,id'
        ];
    }

    public function messages(){
        return [
            'user_image_id.required'    => 'Image must be selected.',
            'user_image_id.exists'      => 'Image must be selected from the four avatars.',
        ];
    }
}
