<?php
namespace App\Traits;

use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailedValidation {

    /**
     * handles Validation error
     * 
     * @param Validator $validator
     */
    protected function validationError(Validator $validator) {
        $error= (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json(['status' => 'error', 'error' => $error
        ],422));
    }
}