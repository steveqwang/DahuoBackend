<?php


namespace App\Logic;

use App\Exceptions\CommonException;
use App\Models\ActivitySign;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Models\VipOrder;
use App\Models\Work;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yansongda\Pay\Pay as Pays;
use Yansongda\Supports\Collection;
use function DI\string;

class PayLogic{

    //微信提现
    public static function weChatWithdraw($openid,$price,$desc='提现'){

        if($price<0.1){
            throw new CommonException('提现金额不能小于0.1元');
        }

        if(!$openid){
            throw new CommonException('openid错误');
        }

        $order = [
            'out_batch_no' => (string)time(),
            'batch_name' => $desc,
            'batch_remark' => $desc,
            'total_amount' => 1,
            'total_num' => 1,
            'transfer_detail_list' => [
                [
                    'out_detail_no' => (string)time(),
                    'transfer_amount' => 1,
                    'transfer_remark' => $desc,
                    'openid' => $openid,
                    // 'user_name' => '闫嵩达'  // 明文传参即可，sdk 会自动加密
                ],
            ]
        ];
        return self::weChat()->transfer($order);
    }


    public static function paySuccessVip($order_no){
        $order = VipOrder::where(['order_no' => $order_no])->first();
        if(!$order){
            throw new CommonException('订单不存在');
        }
        if($order->pay_status == 1){
            throw new CommonException('订单已支付');
        }

        DB::beginTransaction();
        try {
            $res = VipOrder::where(['order_no' => $order_no])->update(['pay_status' => 1,'pay_time' => date('Y-m-d H:i:s'),'status'=>1]);

            $user = User::where(['id'=>$order->id])->first();
            if (!$user){
                throw new CommonException('未找到用户');
            }

            $data['is_vip'] = 1;
            $data['vip_end_time'] = $user->vip_end_time?$user->vip_end_time+$order->days*24*3600:time()+$order->days*24*3600;
            $data['activity_num'] = $user->activity_num>$order->activity_num?$user->activity_num:$order->activity_num;
            $data['search_num'] = $user->search_num>$order->search_num?$user->search_num:$order->search_num;
            $ress = User::where(['id'=>$order->id])->update($data);
            if($res && $ress){
                DB::commit();
                return true;
            }else{
                DB::rollBack();
                return false;
            }
        }catch (\Exception $e){
            DB::rollBack();
            throw new CommonException('支付失败');
        }


    }

    //支付
    /**
     * 订单支付成功回调
     * @throws CommonException
     */
    public static function paySuccess($order_no){

        $order = ActivitySign::where(['order_no' => $order_no])->first();
        if(!$order){
            throw new CommonException('订单不存在');
        }
        if($order->pay_status == 1){
            throw new CommonException('订单已支付');
        }
        if (!in_array($order->type,[3,4])){
            throw new CommonException('订单类型错误');
        }
        $res = ActivitySign::where(['order_no' => $order_no])->update(['pay_status' => 1,'pay_time' => date('Y-m-d H:i:s'),'status'=>2]);
        if(!$res){
            return false;
        }
        return true;

    }


    /**
     * @param string $order_no
     * @param string $openid
     * @param $price
     * @param string $body
     * @return Collection
     */
    public static function weChatMiniAppPay(string $order_no, string $openid,$price,$body='报名活动'){


        $order = [
            'out_trade_no' => $order_no,
            'description' => $body,
            'amount' => [
                'total' => 1,
                'currency' => 'CNY',
            ],
            'payer' => [
                'openid' => $openid,
            ]
        ];

        return self::weChat()->mini($order);


    }

    public static function weChat(){

//        dd(config('pay'));
        return Pays::wechat(config('pay'));
    }


    //退款
    public static function weChatRefund($order_no,$price){

        $order = [
             '_action' => 'mini', // 指定 小程序 退款
            'out_trade_no' => $order_no,
            'out_refund_no' => time(),
            'reason' => '退款',
            'amount' => [
                'refund' => 1,
                'total' => 1,
                'currency' => 'CNY',
            ],
        ];

        $res =  self::weChat()->refund($order);
        if($res['return_code'] == 'SUCCESS' && $res['result_code'] == 'SUCCESS'){
            return true;
        }else{
            Log::error('退款失败',$res);
            throw new CommonException('退款失败');
        }
    }
}
