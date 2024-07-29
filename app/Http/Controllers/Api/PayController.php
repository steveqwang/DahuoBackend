<?php


namespace App\Http\Controllers\Api;

use App\Logic\PayLogic;
use App\Models\ActivitySign;
use App\Models\VipOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayController extends Controller{

    //支付
    public function pay(Request $request){
        $params = $this->validate($request, [
            'order_no' => ['required'],

        ]);

        $firstInitial = substr($params['order_no'], 0, 1);

        $user = $this->user();
        switch ($firstInitial) {
            case 'a':
                $order = ActivitySign::where('order_no',$params['order_no'])->where('user_id',$user->id)->first();

                if (!$order) {
                    return $this->failed(1,'订单不存在');
                }
                if ($order->pay_status == 1) {
                    return $this->failed(1,'订单已支付');
                }
                if (!in_array($order->type,[3,4])){
                    return $this->failed(1,'订单类型错误');
                }

                return PayLogic::weChatMiniAppPay($order->order_no,$this->user()->openid,$order->price);

                break;
            case 'v':
                $order = VipOrder::where('order_no',$params['order_no'])->where('user_id',$user->id)->first();
                if (!$order) {
                    return $this->failed(1,'订单不存在');
                }
                if ($order->pay_status == 1) {
                    return $this->failed(1,'订单已支付');
                }

                return PayLogic::weChatMiniAppPay($order->order_no,$this->user()->openid,$order->price);

                break;
            default:
                return $this->failed(1,'订单号错误');
        }



    }


    public function weChatNotify(){
        $result = PayLogic::weChat()->callback();
        Log::debug(sprintf("微信支付回调 %s  结果: %s", \request()->fullUrl(), \json_encode($result)));
        $arr = json_decode($result,true);

        $order_no = $arr['resource']['ciphertext']['out_trade_no'];
        $firstInitial = substr($order_no, 0, 1);
        switch ($firstInitial) {
            case 'a':

                $res = PayLogic::paySuccess($order_no);
                if($res){
                    return PayLogic::weChat()->success();
                }
                break;
            case 'v':


                $res = PayLogic::paySuccessVip($order_no);
                if($res){
                    return PayLogic::weChat()->success();
                }
                break;
            default:
                return '';
        }
    }

}
