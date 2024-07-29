<?php


namespace App\Exceptions;


use Throwable;

class ForbiddenException extends CommonException
{
    public function __construct($message = "禁止操作", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
