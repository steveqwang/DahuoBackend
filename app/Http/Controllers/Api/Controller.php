<?php


namespace App\Http\Controllers\Api;


use App\Models\User;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * API接口基类
 * Class Controller
 * @package App\Http\Controllers\Api
 */
class Controller extends \App\Http\Controllers\Controller
{
    public function __construct()
    {

        $user = $this->user();
//        if ($user) {
//            \App\Logic\User::request($user);
//        }
        Log::debug(sprintf("接口请求 %s 用户: %s 参数: %s", \request()->fullUrl(), $user ? $user->id : '-', \json_encode(\request()->all())));
    }



    /**
     * @return \Illuminate\Contracts\Auth\Guard|StatefulGuard
     */
    public function guard() {
        return Auth::guard('api');
    }

    /**
     * @return \Illuminate\Contracts\Auth\Authenticatable|User|null
     */
    public function user() {
        return $this->guard()->user();
    }
}
