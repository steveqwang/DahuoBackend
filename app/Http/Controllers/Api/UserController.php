<?php


namespace App\Http\Controllers\Api;


use App\Logic\UserLogic;
use App\Logic\AliLogic;
use App\Logic\WechatLogic;
use App\Models\Activity;
use App\Models\ActivityNotice;
use App\Models\Notice;
use App\Models\Setting;
use App\Models\User;
use App\Models\User_Ti;
use App\Models\UserCoupon;
use App\Models\UserFollow;
use App\Models\UserPrice;
use App\Models\UserSearch;
use App\Models\UserTi;
use Hamcrest\BaseDescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    //我关注的活动
    public function myFollow(Request $request){
        $pageSize = $request->input('pageSize',10);
        $list = Activity::query()->whereIn('status',[2,3,4])->where(function ($query){
            $user = $this->user();
            $user_follow = $user->follows()->pluck('follow_id')->toArray();
//            dd($user_follow);
            $query->where(['user_id'=>$user->id])->orWhereIn('user_id',$user_follow);
        })->with(['user'=>function($query){
            $query->select(['id','nickname','avatar']);
        }])->orderByDesc('id')->paginate($pageSize);

        foreach ($list->items() as $item){
            $item->is_collect = $item->activityCollect()->where('user_id',$this->user()->id)->exists();
            $item->is_sign = $item->sign()->where('user_id',$this->user()->id)->exists();
            $item->is_like = $item->is_like()->where('user_id',$this->user()->id)->exists();
        }


        return $this->success($list,true);
    }


    //他人信息
    public function otherInfo(Request $request){
        $params = $this->validate($request, [
            'user_id' => ['required'],
        ]);
        $user = User::findOrFail($params['user_id']);

        $user_info = $user->loginInfo();
        $user_info['is_follow'] = $this->user()->follows()->where('follow_id',$user->id)->exists();
        return $this->success($user_info);

    }

    //我报名的活动
    public function mySigns(Request $request){
        $pageSize = $request->input('pageSize',10);
        $status = $request->input('status',0);
        $list = Activity::query()->whereHas('sign',function ($query)use($status) {
            $query->where('user_id',$this->user()->id)->where('activity_sign.status','!=',5);

            if ($status==1){
                $query->whereIn('activity_sign.status',[1,2,3]);
            }elseif ($status==2){
                $query->where('activity_sign.status',4);
            }


        })->with(['user'=>function($query){
            $query->select(['id','nickname','avatar']);
        }])->orderBy('id','desc')->paginate($pageSize);
        foreach ($list->items() as $item){
            $item->is_collect = $item->activityCollect()->where('user_id',$this->user()->id)->exists();
        }
        return $this->success($list,true);
    }


    //我发布的活动
    public function myActivity(Request $request){
        $pageSize = $request->input('pageSize',10);
        $list = Activity::where(['user_id'=>$this->user()->id])->whereIn('status',[2,3,4])->orderBy('id','desc')->paginate($pageSize);

        foreach ($list->items() as $item){
            $item->is_collect = $item->activityCollect()->where('user_id',$this->user()->id)->exists();
            $item->is_sign = $item->sign()->where('user_id',$this->user()->id)->exists();
            $item->is_like = $item->is_like()->where('user_id',$this->user()->id)->exists();
        }

        return $this->success($list,true);
    }
    //剩余搜索次数
    public function searchNum(){
        $user = $this->user();
        $search_num = $user->search_num+Setting::where('alias','search_num')->value('value');
        $userSearch = UserSearch::firstOrCreate(['user_id'=>$user->id,'search_date'=>date('Y-m-d')]);
        return $this->success(['search_num'=>$search_num-$userSearch->search_num]);
    }


    //修改搭子类型
    public function editType(Request $request){
        $params = $this->validate($request, [
            'type_ids' => ['required'],
        ]);
        $type_ids = explode(',',$params['type_ids']);
        $user = $this->user();
        $user->types()->sync($type_ids);
        return $this->success();
    }

    //修改兴趣爱好
    public function editInterest(Request $request){
        $params = $this->validate($request, [
            'interest_ids' => ['required'],
        ]);
        $interest_ids = explode(',',$params['interest_ids']);
        $user = $this->user();
        $user->interest()->sync($interest_ids);
        return $this->success();
    }

    //修改搭子偏向
    public function editBias(Request $request){
        $params = $this->validate($request, [
            'bias_ids' => ['required'],
        ]);
        $bias_ids = explode(',',$params['bias_ids']);
        $user = $this->user();
        $user->bias()->sync($bias_ids);
        return $this->success();
    }


    //修改个人资料
    public function editUserInfo(Request $request){
        $params = $this->validate($request, [
            'nickname' => ['string'],
            'avatar' => ['string'],
            'sex' => ['string'],
            'birthday' => ['string'],
            'school' => ['string'],
            'occupation' => ['string'],
            'province_id' => ['string'],
            'city_id' => ['string'],
            'district_id' => ['string'],
            'images' => ['string'],
            'phone' => ['string'],
        ]);
        
        
         
        
        if(isset($params['nickname'])){

            
                $ress = AliLogic::text($params['nickname']);
                
                if(!$ress){
                    return $this->failed(1,'昵称违规');
                }
            

        }
        
        if(isset($params['avatar'])){
           
            if(substr($params['avatar'],0,4)!='http'){
                $ress = AliLogic::image($params['avatar']);
                if(!$ress){
                    return $this->failed(1,'图片违规');
                }
            }

        }
        
        
        User::where('id',$this->user()->id)->update($params);
        return $this->success();
    }


    //粉丝列表
    public function fansList(Request $request){
        $user = $this->user();
        $pageSize = $request->input('pageSize',10);
        $list= UserFollow::where(['follow_id'=>$user->id])->with(['user'=>function($query){
            $query->select(['id','nickname','avatar']);
        }])->orderByDesc('id')->paginate($pageSize);

        foreach ($list->items() as $item){
            $item->is_follow = UserFollow::where(['user_id'=>$user->id,'follow_id'=>$item->user_id])->exists();
        }

        return $this->success($list,true);
    }

    //关注列表
    public function followList(Request $request){

        $user = $this->user();
        $pageSize = $request->input('pageSize',10);
        $list= UserFollow::where(['user_id'=>$user->id])->with(['follow'=>function($query){
            $query->select(['id','nickname','avatar']);
        }])->orderByDesc('id')->paginate($pageSize);

        return $this->success($list,true);
    }


    //关注/取消关注
    public function follow(Request $request){
        $params = $this->validate($request, [
            'user_id' => ['required'],
//            'type' => ['required'],
        ]);
        $user = $this->user();
        if($user->id == $params['user_id']){
            return $this->failed(1,'不能关注自己');
        }
        $res = $user->follows()->toggle($params['user_id']);
        if($res['attached']){
            User::where('id',$params['user_id'])->increment('fans_count');
            User::where('id',$user->id)->increment('follow_count');
        }else{
            User::where('id',$params['user_id'])->decrement('fans_count');
            User::where('id',$user->id)->decrement('follow_count');
        }
        return $this->success();
    }


    //个人资料
    public function userInfo(Request $request){
        $user = $this->user()->loginInfo();
        return $this->success($user);
    }

    //我的收藏
    public function myCollect(Request $request){
        $list = Activity::query()->whereHas('activityCollect',function ($query){
            $query->where('user_id',$this->user()->id);
        })->with(['user'=>function($query){
            $query->select(['id','nickname','avatar']);
        }])->paginate(10);
        return $this->success($list,true);
    }


    //我的下级
    public function mySubordinate(Request $request){
        $pageSize = $request->input('pageSize',10);
        $list = User::where(['invite_user_id'=>$this->user()->id])->select(['id','nickname','avatar','created_at'])->paginate($pageSize);
        return $this->success($list,true);
    }


    //申请提现
    public function applyTi(Request $request){
        $params = $this->validate($request, [
            'price' => ['required','numeric'],
        ]);
        DB::beginTransaction();
        try {
            $res = UserTi::create([
                'user_id' => $this->user()->id,
                'price' => $params['price'],
                'status' => 1,
                'remark' => '申请提现'
            ]);
            $ress = UserLogic::userPrice($this->user()->id,$params['price'],2,'申请提现','申请提现','');
            if($res && $ress){
                DB::commit();
                return $this->success();
            }else{
                DB::rollBack();
                return $this->failed(1,'提现失败');
            }
        }catch (\Exception $e){
            DB::rollBack();
            return $this->failed(1,$e->getMessage());
        }

    }

    //本月收益
    public function monthPrice(){
        $year = date('Y');
        $month = date('m');
        $price = UserPrice::where(['user_id'=>$this->user()->id,'type'=>1])->whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('price');
        return $this->success(['price'=>$price]);
    }

    //今日收益
    public function todayPrice(){
        $today = date('Y-m-d');
        $price = UserPrice::where(['user_id'=>$this->user()->id,'type'=>1])->whereDate('created_at','=',$today)->sum('price');
        return $this->success(['price'=>$price]);
    }


    //资金明细
    public function userPrice(Request $request){
        $type = $request->input('type',0);
        $list = UserPrice::where(['user_id'=>$this->user()->id]);
        if($type){
            $list = $list->where('type',$type);
        }
        $list = $list->orderBy('id','desc')->paginate(10);
        return $this->success($list,true);
    }

    //优惠券列表
    public function couponList(Request $request){
        $status = $request->input('status',1);
        $list = UserCoupon::where(['user_id'=>$this->user()->id,'status'=>$status])->paginate(10);
        return $this->success($list,true);
    }

    //活动通知详情
    public function activityNoticeDetail(Request $request){
        $params = $this->validate($request, [
            'id' => ['required'],
        ]);
        $detail = ActivityNotice::findOrFail($params['id']);
        return $this->success($detail);
    }

    //活动通知
    public function activityNoticeList(Request $request){
        $list = ActivityNotice::where(['user_id'=>$this->user()->id])->orderBy('id','desc')->paginate(10);
        return $this->success($list,true);
    }


    //微信登录
    public function login(Request $request){

        $params = $this->validate($request, [
            'code' => ['required'],
        ]);
        $invite_code = $request->input('invite_code','');
        $response = (new \App\Logic\WechatLogic)->mpLogin($params['code'],$invite_code);
        return $this->success($response);
    }
}
