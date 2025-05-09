<?php

namespace App\Exceptions;

use App\Constants\ErrorCodeEnum;
use App\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InvalidRequestException extends Exception
{

    public function __construct(
        private readonly Validator $validator
    ) {}

    public function report(): void
    {
        //
    }

    public function render(Request $request): JsonResponse
    {
        $error =  ErrorResource::make([
            'title' => 'Invalid Request',
            'description' => 'Validation error invalid fields',
            'fields' => $this->validator->errors()->getMessageBag(),
            'statusCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'errorCode' => ErrorCodeEnum::INVALID_REQUEST
        ]);

        return response()->json(
            $error,
            $error['statusCode']
        );
    }
}
