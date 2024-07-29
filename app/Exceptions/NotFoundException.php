<?php


namespace App\Exceptions;


use Throwable;

class NotFoundException extends CommonException
{
    public function __construct($message = "记录不存在", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
