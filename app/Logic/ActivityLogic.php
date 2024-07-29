<?php


namespace App\Logic;

use App\Exceptions\CommonException;
use App\Models\Activity;
use App\Models\ActivityNotice;
use App\Models\ActivitySign;
use Illuminate\Support\Facades\DB;

class ActivityLogic{

    /**
     * 退出活动
     * @throws CommonException
     */
    public static function quit($activity_id,$user_id,$cancel_reason,$cancel_explain){
        $activity = Activity::query()->where(['id'=>$activity_id])->first();
        if (!$activity){
            throw new CommonException('活动不存在');
        }
        if ($activity->status != 2){
            throw new CommonException('活动状态不正确');
        }
        $sign = ActivitySign::query()->where(['activity_id'=>$activity_id,'user_id'=>$user_id])->whereIn('status',[1,2])->first();
        if (!$sign){
            throw new CommonException('未报名活动');
        }

        if ($sign->status != 1){
            throw new CommonException('活动状态不正确');
        }


        $data = [
            'status'=>5,
            'cancel_reason'=>$cancel_reason,
            'cancel_explain'=>$cancel_explain,
        ];
        if ($sign->status == 2 && !in_array($sign->type,[1,2])){
            PayLogic::weChatRefund($sign->order_no,$sign->price);
            $data['pay_status'] = 2;
        }
        //取消活动
        ActivitySign::query()->where(['id'=>$sign->id])->update($data);
        ActivityNotice::create(['activity_id'=>$activity_id,'user_id'=>$user_id,'title'=>'退出活动','content'=>'退出活动']);
        $activity->decrement('sign_up_number');
        return true;
    }

    /**
     * @throws CommonException
     */
    public static function cancel($activity_id,$user_id): bool
    {
        $activity = Activity::query()->where(['id'=>$activity_id])->first();
        if (!$activity){
            throw new CommonException('活动不存在');
        }

        if ($activity->user_id != $user_id){
            throw new CommonException('无权限取消');
        }
        if ($activity->status != 2 && $activity->status != 1){
            throw new CommonException('活动状态不正确');
        }

        DB::beginTransaction();
        try {
            $activity->status = 6;
            $activity->save();

            $list = ActivitySign::query()->where(['activity_id'=>$activity_id])->get()->toArray();
            foreach ($list as $item){
                $data = [
                    'status'=>5,
                    'cancel_reason'=>'活动发布人取消活动',
                    'cancel_explain'=>'活动发布人取消活动',

                ];
                if ($item['status'] == 2 && !in_array($item['type'],[1,2])){
                    //退款
                    PayLogic::weChatRefund($item['order_no'],$item['price']);
                    $data['pay_status'] = 2;
                }
                //取消活动
                ActivitySign::query()->where(['id'=>$item['id']])->update($data);
                ActivityNotice::create(['activity_id'=>$activity_id,'user_id'=>$item['user_id'],'title'=>'活动发布人取消活动','content'=>'活动发布人取消活动']);
            }
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }
}
