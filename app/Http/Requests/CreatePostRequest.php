<?php

namespace App\Http\Requests;

use App\Http\traits\FailedValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    use FailedValidationTrait;

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
        ];
    }
}
