<?php

namespace App\Http\Requests\Events;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FailedValidation;

class EventsRequest extends FormRequest
{

    /**
     * trait for validation error handler.
     */
    use FailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $str =\Request::route()->uri;
        $pattern = '/(api\/events)(\/[a-zA-Z0-9])*/';
        return preg_match($pattern,$str);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "event_name" => "required",
            "host" => "required",
            "event_date" => "date",
        ];
    }
    /**
     * function that handles validation error
     * 
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
       $this->validationError( $validator);
    }
}
