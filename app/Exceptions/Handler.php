<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report($exception)
    {
        $request = \request();
        Log::warning(sprintf("接口: %s 参数： %s", $request->fullUrl(), json_encode($request->input())));
        Log::warning(sprintf("Exception: %s %s %d", get_class($exception), $exception->getMessage(), $exception->getCode()));
        if ($exception instanceof ValidationException) {
            Log::warning(sprintf("参数错误： 错误信息 %s", json_encode($exception->errors())));
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, $exception)
    {
        if (Str::startsWith($request->getPathInfo(), '/api')) {
            if ($exception instanceof AuthenticationException) {
                $body = [
                    'code' => 401,
                    'msg' => '请登录',
                ];
            } elseif ($exception instanceof ModelNotFoundException) {
                $body = [
                    'code'=> 404,
                    'msg' => '记录不存在',
                ];
            } else {
                $body = [
                    'code' => $exception->getCode() > 0 ? $exception->getCode() : 400,
                    'msg' => $this->getExceptionMessage($exception),
                ];
            }
            return response()->json($body, 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return parent::render($request, $exception);
        }
    }

    private function getExceptionMessage(Exception $exception) {
        $msg = Config::get('exception.messages.' . get_class($exception));

        return !empty($msg) ? $msg : $exception->getMessage();
    }
}
