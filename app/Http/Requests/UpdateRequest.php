<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules() 
    {
        return [
            'user_name' => 'required|max:50',
            'first_name' => 'required|max:50',
            'birtday' => 'date|before:2001-04-15',
            'avatar' => 'image|mimes:jpg,png,jpeg',
            'last_name' => 'required|max:50',
            'email' => 'required|email',
           
           ];
    }
    public function messages() {
        return [];
    }
}
