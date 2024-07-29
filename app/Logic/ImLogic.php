<?php


namespace App\Logic;


use TencentCloud\Common\Credential;

class ImLogic{
    public static function UserSig($id){
        $UserSig = new \Tencent\TLSSigAPIv2(env('IMappid'),env('IMkey'));
        return  $UserSig->genUserSig($id);
    }
}
