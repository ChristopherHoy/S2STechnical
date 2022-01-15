<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Exceptions\ValidateException;

class Validatable extends FormRequest
{
    // Get the validation rules that apply to the request.
    //Required by laravel
    public function rules(){
        return [];
    }


    // Validates the request
    // Will throw a ValidateException if there is an error
    public function validate($validations) {
        $validator = Validator::make($this->all(), $validations);

        if ($validator->fails()) {
            $exception = new ValidateException($validator->errors());
            throw $exception;
        }
    }
}
