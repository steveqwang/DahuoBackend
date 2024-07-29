<?php


namespace App\Http\Controllers\Api;

use App\Logic\ActivityLogic;
use App\Logic\WechatLogic;
use App\Models\Activity;
use App\Models\ActivityComment;
use App\Models\ActivityNotLike;
use App\Models\ActivityQa;
use App\Models\ActivitySign;
use App\Models\ActivityType;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserCollection;
use App\Models\UserCoupon;
use App\Models\UserLike;
use App\Models\UserSearch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ActivityController extends Controller{

    //获取小程序url
    public function getMpUrl(Request $request)
    {

        $res = WechatLogic::getMpUrl(1,2);
        return $this->success($res);
    }

    //小程序码
    public function getQrCode(Request $request)
    {

            $params = $this->validate($request, [
                'activity_id' => ['required'],
            ]);
            $activity = Activity::findOrFail($params['activity_id']);
            $user = User::find($activity->user_id);
            $res = WechatLogic::getQrCode($activity->id,$user->invite_code);
            return $this->success($res);

    }

    //点赞/取消点赞
    public function like(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
        ]);
        $activity = Activity::findOrFail($params['activity_id']);
        $user = $this->user();
        if ($activity->is_like()->where('user_id',$user->id)->exists()){
            UserLike::where(['activity_id'=>$activity->id,'user_id'=>$user->id])->delete();
            $activity->decrement('like_num');
        }else{
            UserLike::create(['activity_id'=>$activity->id,'user_id'=>$user->id]);
            $activity->increment('like_num');
        }
        return $this->success();
    }


    //别人参加的活动
    public function otherSignList(Request $request){
        $params = $this->validate($request, [
            'user_id' => ['required'],
        ]);
        $list = Activity::query()->whereIn('status',[2,3,4])->whereHas('sign',function ($query)use($params) {
            $query->where('user_id',$params['user_id'])->where('activity_sign.status','!=',5);
        })->with(['user'=>function($query){
            $query->select('id','nickname','avatar');
        }])->orderBy('id','desc')->paginate(10);

        return $this->success($list,true);
    }


    //别人发布的活动
    public function otherList(Request $request){
        $params = $this->validate($request, [
            'user_id' => ['required'],
        ]);
        $list = Activity::where(['user_id'=>$params['user_id']])->whereIn('status',[2,3,4])->with(['user'=>function($query){
            $query->select('id','nickname','avatar');
        }]);

        $list = $list->orderByDesc('created_at')->paginate(10);
        return $this->success($list,true);
    }


    //模板列表
    public function prohibitList(Request $request){
        $list = Activity::where('is_open','=',1)->where('is_prohibit','=',1)
            ->whereIn('status',[2,3,4])->where('type',4)->with(['user'=>function($query){
            $query->select('id','nickname','avatar');
        }]);

        $activity_type_id = $request->input('activity_type_id',0);


        $longitude = $request->input('longitude',0);
        $latitude = $request->input('latitude',0);

        $order_field = $request->input('order_field','');

        if ($activity_type_id){
            $list->where('activity_type_id',$activity_type_id);
        }
        if($longitude && $latitude && $order_field=='distance'){
            $list->selectRaw("*,ROUND(6378.138*2*ASIN(SQRT(POW(SIN(($latitude*PI()/180-latitude*PI()/180)/2),2)+COS($latitude*PI()/180)*COS(latitude*PI()/180)*POW(SIN(($longitude*PI()/180-longitude*PI()/180)/2),2)))*1000) AS distance");
            $list->orderBy('distance');
        }

        if ($order_field=='min_price'){
            $list->orderBy('price','asc');
        }
        if ($order_field=='max_price'){
            $list->orderBy('price','desc');
        }
        $list = $list->orderByDesc('created_at')->paginate(10);
        return $this->success($list,true);
    }


    //活动不喜欢
    public function dislike(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
            'reason' => ['required'],
        ]);
        $activity = Activity::findOrFail($params['activity_id']);
        $user = $this->user();
        ActivityNotLike::firstOrCreate(['activity_id'=>$activity->id,'user_id'=>$user->id,'reason'=>$params['reason']]);
        return $this->success();
    }


    //活动不喜欢列表
    public function dislikeList(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
        ]);
        $list = ActivityNotLike::where(['activity_id'=>$params['activity_id']])->with(['user'=>function($query){
            $query->select('id','nickname','avatar');
        }])->orderByDesc('created_at')->paginate(10);
        return $this->success($list,true);
    }


    //取消收藏活动
    public function cancelCollect(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
        ]);
        $activity = Activity::findOrFail($params['activity_id']);
        $user = $this->user();
        if (!$activity->activityCollect()->where('user_id',$user->id)->exists()){
            return $this->failed('1','未收藏');
        }
        UserCollection::where(['activity_id'=>$activity->id,'user_id'=>$user->id])->delete();
        return $this->success();
    }

    //收藏活动
    public function collect(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
        ]);
        $activity = Activity::findOrFail($params['activity_id']);
        $user = $this->user();
        if ($activity->activityCollect()->where('user_id',$user->id)->exists()){
            return $this->failed('1','已收藏');
        }
       UserCollection::create(['activity_id'=>$activity->id,'user_id'=>$user->id]);

        return $this->success();
    }

    //回复评价
    public function replyComment(Request $request){
        $params = $this->validate($request, [
            'id' => ['required'],
            'reply_content' => ['required'],
        ]);
        $comment = ActivityComment::findOrFail($params['id']);
        if ($comment->activity->user_id!=$this->user()->id){
            return $this->failed('1','无权限');
        }
        $comment->update(['reply_content'=>$params['reply_content']]);
        return $this->success();
    }


    //活动评价
    public function comment(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
            'content' => ['required'],
            'star' => ['required'],
        ]);
        $activity = Activity::findOrFail($params['activity_id']);
        if ($activity->status!=4){
            return $this->failed('1','活动未结束');
        }
        $user = $this->user();
        if ($activity->activityComment()->where('user_id',$user->id)->exists()){
            return $this->failed('1','已评价');
        }
        if ($activity->activitySign()->where('user_id',$user->id)->where('activity_sign.status',4)->doesntExist()){
            return $this->failed('1','未参加活动');
        }
        $data = [
            'activity_id' => $activity->id,
            'user_id' => $user->id,
            'content' => $params['content'],
            'star' => $params['star'],
        ];
        ActivitySign::create($data);
        return $this->success();
    }

    //活动回答
    public function qaAnswer(Request $request){
        $params = $this->validate($request, [
            'id' => ['required'],
            'a_content' => ['required'],
        ]);
        $qa = ActivityQa::findOrFail($params['id']);
        if ($qa->a_user_id){
            return $this->failed('1','已回答');
        }
        $qa->update(['a_user_id'=>$this->user()->id,'a_content'=>$params['a_content'],'status'=>2]);
        return $this->success();
    }

    //活动提问
    public function qa(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
            'q_content' => ['required'],
        ]);
        $activity = Activity::findOrFail($params['activity_id']);
        $data = [
            'activity_id' => $activity->id,
            'q_user_id' => $this->user()->id,
            'q_content' => $params['q_content'],
        ];
        ActivityQa::create($data);
        return $this->success();
    }


    //活动问答列表
    public function qaList(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
        ]);
        $list = ActivityQa::where(['activity_id'=>$params['activity_id']])->with(['q_user'=>function($query){
            $query->select('id','nickname','avatar');
        },'a_user'=>function($query){
            $query->select('id','nickname','avatar');
        }])->orderByDesc('created_at')->paginate(10);
        return $this->success($list,true);
    }

    //退出活动
    public function quit(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
            'cancel_reason' => ['required'],
            'cancel_explain' => ['required'],
        ]);
        $res = ActivityLogic::quit($params['activity_id'],$this->user()->id,$params['cancel_reason'],$params['cancel_explain']);
        if(!$res){
            return $this->failed('1','退出失败');
        }
        return $this->success();
    }

    //取消活动
    public function cancel(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
        ]);
        $res = ActivityLogic::cancel($params['activity_id'],$this->user()->id);
        if(!$res){
            return $this->failed('1','取消失败');
        }
        return $this->success();
    }


    //活动权限设置
    public function activitySet(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
            'is_open' => ['required',Rule::in([0,1])],
            'is_prohibit' => ['required',Rule::in([0,1])],
        ]);
        $params['id'] = $params['activity_id'];
        unset($params['activity_id']);
        $res = Activity::where('user_id',$this->user()->id)->where(['id'=>$params['id']])->update($params);
        if (!$res) {
            return $this->failed('1','设置失败');
        }
        return $this->success();
    }



    //活动报名
    public function sign(Request $request){
        $params = $this->validate($request, [
            'activity_id' => ['required'],
            'name' => ['required'],
            'phone' => ['required'],
            'emergency_contact' => ['required'],
            'emergency_contact_phone' => ['required'],
        ]);
        $activity = Activity::query()->where(['status'=>2])->findOrFail($params['activity_id']);
        if ($activity->activity_number<=$activity->sign_up_number){
            return $this->failed('1','活动人数已满');
        }
        if ($activity->sign_up_end_time<date('Y-m-d H:i:s')){
            return $this->failed('1','报名已结束');
        }
        $user = $this->user();
        if ($activity->activitySign()->where('user_id',$user->id)->whereIn('activity_sign.status',[1,2])->exists()){
            return $this->failed('1','已报名');
        }



        DB::beginTransaction();
        try {
            $activity->increment('sign_up_number');
            if($user->sex==1){
                $activity->increment('nan_num');
            }elseif ($user->sex==2){
                $activity->increment('nv_num');
            }
            $data = [
                'activity_id' => $activity->id,
                'type' => $activity->type,
                'user_id' => $user->id,
                'order_no' => 'a'.date('YmdHis').rand(100000,999999),
                'price' => $activity->price,
                'name' => $params['name'],
                'phone' => $params['phone'],
                'sex' => $user->sex,
                'emergency_contact' => $params['emergency_contact'],
                'emergency_contact_phone' => $params['emergency_contact_phone'],
            ];
            $is_pay = true;
            if($activity->type==1 || $activity->type==2){
                $data['pay_status'] = 1;
                $data['status'] = 1;
                $is_pay = false;
            }


            ActivitySign::create($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->failed('1','报名失败');
        }


        return $this->success(['order_no'=>$data['order_no'],'is_pay'=>$is_pay]);
    }

    //活动列表
    public function list(Request $request){

        $type = $request->input('type',0);
        if (!in_array($type,[0,1,2,3,4])){
            return $this->failed('1','参数错误');
        }

        $user_coupon_id = $request->input('user_coupon_id',0);
        $status = $request->input('status',2);
        $activity_type_id = $request->input('activity_type_id',0);
        $activity_date = $request->input('activity_date',0);
        $min_price = $request->input('min_price',0);
        $max_price = $request->input('max_price',0);
        $longitude = $request->input('longitude',0);
        $latitude = $request->input('latitude',0);
        $min_distance = $request->input('min_distance',0);
        $max_distance = $request->input('max_distance',0);
        $sex = $request->input('sex',0);
        $min_activity_number = $request->input('min_activity_number',0);
        $max_activity_number = $request->input('max_activity_number',0);
        $is_search = $request->input('is_search',0);
        $province_id = $request->input('province_id',0);
        $city_id = $request->input('city_id',0);
        $district_id = $request->input('district_id',0);


        $list = Activity::where('is_open','=',1);
        if($province_id){
            $list->where('province_id',$province_id);
        }
        if($city_id){
            $list->where('city_id',$city_id);
        }
        if($district_id){
            $list->where('district_id',$district_id);
        }
        if($type){
            $list->where('type',$type);
        }
        if($status){
            $list->where('status',$status);
        }
        if($activity_type_id){
            $list->where('activity_type_id',$activity_type_id);
        }
        if($activity_date){
            $list->where('activity_date',$activity_date);
        }
        if($min_price){
            $list->where('price','>=',$min_price);
        }
        if($max_price){
            $list->where('price','<=',$max_price);
        }
        if($longitude && $latitude){
            $list->selectRaw("*,ROUND(6378.138*2*ASIN(SQRT(POW(SIN(($latitude*PI()/180-latitude*PI()/180)/2),2)+COS($latitude*PI()/180)*COS(latitude*PI()/180)*POW(SIN(($longitude*PI()/180-longitude*PI()/180)/2),2)))*1000) AS distance");
           if($min_distance && $max_distance){
               $list->having('distance','>=',$min_distance);
               $list->having('distance','<=',$max_distance);
           }
            $list->orderBy('distance');
        }
        if($min_activity_number){
            $list->where('activity_number','>=',$min_activity_number);
        }
        if($max_activity_number){
            $list->where('activity_number','<=',$max_activity_number);
        }
        switch ($sex){
            case 1:
                $list->whereColumn('nan_num','>=','nv_num');
                break;
            case 2:
                $list->where('nv_num','>=','nan_num');
                break;
            default:
                break;
        }
        $user = $this->user();
        if($user){
            $pageSize = $user->activity_num??Setting::where('alias','activity_num')->value('value');
            if ($is_search){
                if ($user_coupon_id){
                    $userCoupon = UserCoupon::where('id',$user_coupon_id)->where('user_id',$user->id)->first();
                    if (!$userCoupon){
                        return $this->failed('1','优惠券不存在');
                    }
                    if ($userCoupon->status!=1){
                        return $this->failed('1','优惠券已使用');
                    }
                    $userCoupon->update(['status'=>2]);

                }else{
                    $search_num = $user->search_num+Setting::where('alias','search_num')->value('value');
                    $userSearch = UserSearch::firstOrCreate(['user_id'=>$user->id,'search_date'=>date('Y-m-d')]);
                    if ($userSearch->search_num>=$search_num){
                        return $this->failed('1','搜索次数已用完');
                    }
                    $userSearch->increment('search_num');
                }

            }
        }else{
            $pageSize = Setting::where('alias','activity_num')->value('value');
            $user = (object)['id'=>0];
        }
        $list = $list->with(['user'=>function($query){
            $query->select('id','nickname','avatar');
        }])->orderByDesc('created_at')->paginate($pageSize);

        foreach ($list->items() as $item){
            $item->is_sign = $item->activitySign()->where('user_id',$user->id)->exists();
            $item->is_collect = $item->activityCollect()->where('user_id',$user->id)->exists();
            $item->is_like = $item->is_like()->where('user_id',$user->id)->exists();
        }

        return $this->success($list,true);

    }

    //活动详情
    public function detail(Request $request){
        $params = $this->validate($request, [
            'id' => ['required'],
        ]);
        $detail = Activity::query()->with(['activityType','user'=>function($query){
            $query->select('id','nickname','avatar');
        },'activitySign'=>function($query){
            $query->select('activity_id','user_id','nickname','avatar');
        },'activityComment'=>function($query){
            $query->select('id','activity_id','user_id','content','star','reply_content','created_at')->with(['user'=>function($query){
                $query->select('id','nickname','avatar');
            }]);
        },'ActivityQa'=>function($query){
            $query->select('id','activity_id','q_user_id','q_content','status','a_user_id','a_content')->with(['q_user'=>function($query){
                $query->select('id','nickname','avatar');
            },'a_user'=>function($query){
                $query->select('id','nickname','avatar');
            }]);
        }])->findOrFail($params['id']);

        $detail->increment('read_number');

        $user = $this->user();
        if($user){
            $detail->is_sign = $detail->activitySign()->where('user_id',$user->id)->exists();
            $detail->is_collect = $detail->activityCollect()->where('user_id',$user->id)->exists();
            $detail->is_like = $detail->is_like()->where('user_id',$user->id)->exists();
        }else{
            $detail->is_sign = false;
            $detail->is_collect = false;
            $detail->is_like = false;
        }




        return $this->success($detail);
    }


    //活动类型列表
    public function typeList(Request $request){
        $pid = $request->input('pid',0);

        $list = ActivityType::where('status',1);

        if($pid){
            $list->where('pid',$pid);
        }

        $list = $list->orderByDesc('sort')->get();
        return $this->success($list);
    }


    //发布活动
    public function publish(Request $request){
        $params = $this->validate($request, [
            'title' => ['required'],
            'activity_type_id' => ['required'],
            'image' => ['required'],
            'images' => ['required'],
            'activity_date' => ['required','date'],
            'start_time' => ['required'],
            'end_time' => ['required'],
            'sign_up_end_time' => ['required'],
            'activity_number' => ['required'],
            'address' => ['required'],
            'content' => ['required'],
            'longitude' => ['required'],
            'latitude' => ['required'],
            'price' => ['required'],
            'is_open' => ['required'],
            'is_prohibit' => ['required'],
            'province_id' => ['required'],
            'city_id' => ['required'],
            'district_id' => ['required'],
            'activity_address' => ['required'],
            'type' => ['required',Rule::in([1,2,3,4])],
            'underlined_price' => ['required'],
            'pid' => ['required'],
        ]);
        $params['user_id'] = $this->user()->id;

        $id = $request->input('id',0);
        if($id){
            $detail = Activity::query()->where(['user_id'=>$params['user_id'],'id'=>$id])->findOrFail($id);
            if ($detail->status!=1){
                return $this->failed('1','活动已发布');
            }
            $activity = Activity::query()->where(['user_id'=>$params['user_id'],'id'=>$id])->update($params);
        }else{
            $activity = Activity::create($params);
        }

        if (!$activity) {
            return $this->failed('1','发布失败');
        }
        return $this->success();
    }

}
