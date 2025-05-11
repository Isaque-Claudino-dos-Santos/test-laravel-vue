<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use App\Constants\ErrorCodeEnum;

class ErrorResource extends JsonResource
{

    private function getErrorCode()
    {
        $errorCode = Arr::get($this, 'errorCode');

        if ($errorCode instanceof ErrorCodeEnum) {
            return $errorCode->name;
        }

        return $errorCode;
    }

    public function toArray(Request $request): array
    {
        return [
            'title' => Arr::get($this, 'title'),
            'description' => Arr::get($this, 'description'),
            'status_code' => Arr::get($this, 'statusCode'),
            'error_code' => $this->getErrorCode(),
            'fields' => Arr::get($this, 'fields'),
            'instance' => Arr::get($this, 'instance'),
            'timestamp' => Carbon::now()->toDateTimeString()
        ];
    }
}
