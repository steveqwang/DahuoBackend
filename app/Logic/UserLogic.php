<?php


namespace App\Logic;
use App\Exceptions\CommonException;



use App\Models\User;
use App\Models\UserPrice;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class UserLogic{

    public static function userPrice($user_id,$price,$type,$remark,$content,$order_no){
        $user = User::find($user_id);
        if(!$user){
            throw new CommonException('用户不存在');
        }
        switch ($type){
            case 1:

                $user->balance += $price;
                break;
            case 2:
                if ($user->price < $price) {
                    throw new CommonException('余额不足');
                }
                $user->price -= $price;
                break;
            default:
                throw new CommonException('类型错误');
        }
        DB::beginTransaction();
        try {
            $res = $user->save();
            $ress = UserPrice::create([
                'user_id' => $user_id,
                'price' => $price,
                'type' => $type,
                'remark' => $remark,
                'content' => $content,
                'order_no' => $order_no
            ]);
            if($res && $ress){
                DB::commit();
                return true;
            }else{
                DB::rollBack();
                return false;
            }
        }catch (Exception $e){
            DB::rollBack();
            throw new CommonException($e->getMessage());
        }
    }

    /**
     * 绑定微信手机号
     * @param User $user
     * @param string $encrypt
     * @param string $iv
     * @throws CommonException
     */
    public static function bindMobile(User $user, string $encrypt, string $iv) {
        $mp = WechatLogic::getMp();
        try {
            $result = $mp->encryptor->decryptData($user->session_key, $iv, $encrypt);
            Log::debug("解密数据: " . json_encode($result));
        } catch (Exception $exception) {
            Log::error(json_encode($exception->getMessage()));
            throw new CommonException("解密失败");

        }

        $phone = Arr::get($result, 'purePhoneNumber');
        if (empty($phone)) {
            throw new CommonException("解密失败,未获取到手机号");
        }

        if ($user->phone != $phone) { // 当且仅当手机号不相同时修改并记录日志
            if (!empty($user->phone)) {
                Log::info(sprintf("用户 %d 更换手机号 %s %s", $user->id, $user->phone, $phone));
            }

            $user->phone = $phone;
            $user->save();
        }

    }
    /**
     * 查找或创建 如果不存在则新建
     * @param string $openid 用户openid
     * @param string $attributes 额外参数
     * @return User
     * @throws Exception
     */
    public static function findOrCreateByOpenid(string $openid, string $invite_code) {
        $attributes['openid'] = $openid;
        try {
            DB::beginTransaction();
            $new = false;
            $user = User::firstOrCreate(['openid' => $openid], $attributes);
            if (empty($user->my_invite_code)) {
//                self::user_notice($user->id,'您已注册成功，可按各专业通知了解相关操作流程！');
                $user->my_invite_code = self::genCode($user->id);

                $user->save();
                $new = true;
            }

            // fire user created event
            if ($user->wasRecentlyCreated) {
                if (!empty($invite_code)) {
                    $invite_user = User::where('my_invite_code', $invite_code)->first();
                    if ($invite_user) {
                        $user->invite_user_id = $invite_user->id;
                        $user->invite_code = $invite_code;
                        $user->save();
                    }
                }
            }

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
        $user->is_new = $new;
        return $user;
    }
    /**
     * 执行登录逻辑
     * @param User $user
     * @return string
     * @throws CommonException
     */
    public static function apiLogin(User $user) {
//        if($user->status== User::STATUS_DISABLE) {
//            throw new CommonException("当前用户已禁用");
//        }

        $token = \hash('sha256', Str::random(64));
        $im_token = ImLogic::UserSig($user->id);
        $user->forceFill([
            'api_token' => $token,
            'im_token' => $im_token,
        ])->save();

        return $token;
    }
    public static function genCode(int $id) {
        $base = 65;
        $step = 26;
        $str = "";
        $q = $id + 10000000;

        while(true) {
            $r = $q % $step;
            $str = chr($r + $base) . $str;
            $q = (int) ($q / $step);
            if ($q === 0) {
                break;
            }
        }

        return $str;
    }
}
