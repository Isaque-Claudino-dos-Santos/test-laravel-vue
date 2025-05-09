<?php


namespace App\Http\traits;

use App\Exceptions\InvalidRequestException;
use Illuminate\Contracts\Validation\Validator;

trait FailedValidationTrait
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new InvalidRequestException($validator);
    }
}
