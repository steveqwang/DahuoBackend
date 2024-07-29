<?php


namespace App\Exceptions;


use Throwable;

class ParamException extends CommonException
{
    public function __construct($message = "参数错误", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
