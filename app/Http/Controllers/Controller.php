<?php

namespace App\Http\Controllers;

use App\Exceptions\ParamException;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs;
    use ValidatesRequests {
        validate as public rValidate;
    }
    /**
     * 参数校验
     * @param Request $request
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return array
     * @throws ParamException
     */
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        try {
            return $this->rValidate($request, $rules, $messages, $customAttributes);
        } catch (Exception $exception) {
            Log::warning(sprintf("参数校验失败: %s %s %s", json_encode($request->all()), get_class($exception), json_encode($exception->getMessage())));
            if ($exception instanceof ValidationException) {
                Log::warning(sprintf("错误信息 %s", $exception->validator->errors()));
            }
            $error = $exception->validator->errors()->toArray();
            $errStr = '';
            foreach ($error as $k=>$v){
                $errStr .= $v[0].',';
            }

            $this->throwParamException($errStr?trim($errStr,','):'参数错误');
        }
    }

    /**
     * @param string $message
     * @throws ParamException
     */
    public function throwParamException($message = "参数错误")
    {
        throw new ParamException($message);
    }
    public function success($body = [],$page = false) {
        return $this->response(0, 'ok', $body,$page);
    }

    public function failed( $code = 1,$msg = 'failed', $body = []) {
        return $this->response($code, $msg, $body);
    }

    public function response($code, $msg = 'ok', $body = [],$page=false) {
        $data = [
            'code' => $code,
            'msg' => $msg,
        ];
        if (!empty($body) && $page==false) {

            $data['data'] = $body;


        }elseif (!empty($body) && $page==true){
            $data['data'] = $body->items();
            $limit['total'] = $body->total();
            $limit['page'] = $body->currentPage();
            $limit['size'] = $body->perPage();
            $data['limit'] = $limit;
        }
        return response()->json($data, 200, [], JSON_UNESCAPED_UNICODE);
    }
}
