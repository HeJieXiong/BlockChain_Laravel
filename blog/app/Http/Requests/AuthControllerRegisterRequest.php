<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Controllers\Controller;

class AuthControllerRegisterRequest extends FormRequest
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
            'username' => 'required|unique:users,id|min:6|max:16',
            'password' => 'required|string|min:6|max:16', 
            'full_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            Controller::responseError($validator->errors()->first())
        );
    }
}
