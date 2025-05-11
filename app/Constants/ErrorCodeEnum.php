<?php


namespace App\Constants;


enum ErrorCodeEnum
{
    case INVALID_REQUEST;
    case UNAUTHENTICATED;
    case PERMISSION_DENIED;
}
