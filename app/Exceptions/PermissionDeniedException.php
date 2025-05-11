<?php

namespace App\Exceptions;

use App\Constants\ErrorCodeEnum;
use App\Http\Resources\ErrorResource;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionDeniedException extends Exception
{
    public function report(): void
    {
        //
    }

    public function render(Request $request): JsonResponse
    {
        $error = ErrorResource::make([
            'title' => 'Permission Denied',
            'description' => 'You do not have the necessary permission.',
            'statusCode' => Response::HTTP_UNAUTHORIZED,
            'errorCode' => ErrorCodeEnum::PERMISSION_DENIED,
        ]);

        return response()->json(
            $error,
            $error['statusCode']
        );
    }
}
