<?php


namespace App\Exceptions;


use Throwable;

/**
 * API接口异常基类
 * Class CommonException
 * @package App\Exceptions
 */
class CommonException extends \Exception
{
    public function __construct($message = "", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
