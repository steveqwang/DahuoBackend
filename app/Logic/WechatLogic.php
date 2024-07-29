<?php


namespace App\Logic;

use App\Exceptions\CommonException;
use App\Models\User;
use EasyWeChat\MiniProgram\Application as MiniProgram;
use EasyWeChat\Payment\Application as Payment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Overtrue\LaravelWeChat\Facade as EasyWeChat;

class WechatLogic{

    //获取小程序url
    public static function getMpUrl($id,$invite_code){
        return self::getMp()->url_link->generate(['path' => '/pagesActivity/activityDetails/index?id='.$id.'&invite_code='.$invite_code]);
    }


    /**
     * 小程序登录
     * @param string $code
     * @param string $invite_code
     * @return array
     * @throws CommonException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     */
    public function mpLogin(string $code,string $invite_code) {
        $session = self::getMp()->auth->session($code);

        if (Arr::get($session, 'errcode') != 0) {
            Log::warning("微信小程序 登录失败: " . json_encode($session));
            throw new CommonException("登录失败");
        }

        $user = UserLogic::findOrCreateByOpenid($session['openid'],$invite_code);
        $user->session_key = Arr::get($session, 'session_key', '');
        $is_new = $user->is_new;
        unset($user->is_new);
        $token = UserLogic::apiLogin($user);
//        $response = $user->loginInfo();
        $response = array();
        $response['api_token'] = $token;
        $response['is_new'] = $is_new;
        return $response;
    }
    /**
     * @return MiniProgram
     */
    public static function getMp() {
        return EasyWeChat::miniProgram();
    }

    /**
     * @return Payment
     */
    public static function getPayment() {
        return EasyWeChat::payment();
    }
    //小程序码
    public static function getQrCode($id,$invite_code){
        $response =   self::getMp()->app_code->get('/pagesActivity/activityDetails/index?id='.$id.'&invite_code='.$invite_code);
        if ($response instanceof \EasyWeChat\Kernel\Http\StreamResponse) {
//           $res =  Storage::put('qrcode/qrcode'.$id.'.png', $response->getBody(), 'public');
//           //上传到OSS
//
//           dd($res);
            $filename = $response->save(public_path().'/uploads/qrcode', 'qrcode'.$id.'.png');
            return Storage::disk('public')->putFile('qrcode', public_path().'/uploads/qrcode/'.$filename);


        }

    }
}
