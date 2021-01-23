<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|max:250',
            'name' => 'required|string|max:250',
            'firstName' => 'required|string|max:250',
            'secondName' => 'required|string|max:250',
            'cat_profile_id' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'username' => 'El Usuario ya existe en el sistema',


        ];
    }
}
