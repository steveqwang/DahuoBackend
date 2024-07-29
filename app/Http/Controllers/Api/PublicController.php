<?php


namespace App\Http\Controllers\Api;



use App\Logic\ImLogic;
use App\Models\Banner;
use App\Models\DaziBias;
use App\Models\DaziType;
use App\Models\Interest;
use App\Models\Notice;
use App\Models\Setting;
use App\Models\Vip;
use Illuminate\Http\Request;

class PublicController extends Controller{

    public function test(){

    }

    //会员列表
    public function vipList(Request $request){
        $list = Vip::where(['status'=>1])->orderByDesc('sort')->get();
        return $this->success($list);
    }

    //偏向列表
    public function biasList(Request $request){
        $list = DaziBias::where(['status'=>1])->orderByDesc('sort')->get();
        return $this->success($list);
    }

    //兴趣爱好列表
    public function interestList(Request $request){
        $list = Interest::where(['status'=>1])->orderByDesc('sort')->get();
        return $this->success($list);
    }

    //搭子类型列表
    public function typeList(Request $request){
        $list = DaziType::where(['status'=>1])->orderByDesc('sort')->get();
        return $this->success($list);
    }

    //轮播图列表
    public function bannerList(Request $request){
        $list = Banner::where('status',1)->orderBy('sort','desc')->orderBy('id','desc')->get();
        return $this->success($list);
    }

    //平台消息详情
    public function noticeDetail(Request $request){
        $params = $this->validate($request, [
            'id' => ['required'],
        ]);
        $detail = Notice::findOrFail($params['id']);
        return $this->success($detail);
    }

    //平台消息列表
    public function noticeList(Request $request){
        $list = Notice::where('status',1)->orderBy('id','desc')->orderBy('id','desc')->paginate(10);
        return $this->success($list,true);
    }


    //上传文件
    public function upload(Request $request) {

        $urls = [];
        foreach ($request->file() as $file) {
            $urls[] = $file->store('images/' . date('Ymd'), 'public');
        }


        return $this->success($urls);
    }


    //公共设置
    public function setting(Request $request){
        $params = $this->validate($request, [
            'alias' => ['required'],

        ]);

        $detail = Setting::whereIn('alias',explode(',',$params['alias']))->pluck('value','alias');
        return $this->success($detail);
    }
}
