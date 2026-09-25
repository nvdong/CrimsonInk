<?php


namespace App\Exceptions;


use Illuminate\Http\Response;

class AppException extends AbstractException
{
    const ERR_NONE = 0;
    const ERR_SYSTEM = 1;
    const ERR_VALIDATION = 2;
    const ERR_OBJECT_NOT_FOUND = 3;
    const ERR_INVALID_TOKEN = 4;
    const ERR_USER_NOT_FOUND = 5;

    public function __construct($code = null, $message = '')
    {
        if (!$message) {
            $message = __('exception.'.$code);
        }

        if (!$code) {
            $code = Response::HTTP_NOT_FOUND;
        }
        parent::__construct($code, $message);
    }
}
