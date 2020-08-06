<?php

namespace App\Http\Requests\Users;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FailedValidation;

class UserRequest extends FormRequest
{
    /**
     * trait for validation error handler.
     */
    use FailedValidation;

    /**
     * determine if the user is authorized to perform validation.
     * 
     * @return bool
     */
    public function authorize()
    {
        return  \Request::route()->uri == "api/register";
    }
 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'bail|required',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:8',
            'confirmPassword' => 'required|same:password',
        ];
    }
 
    
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
       $this->validationError( $validator);       
    }
}
