<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class User
 * @package App\Models
 * @property string id
 * @property string nickname
 * @property string avatar
 * @property string phone
 * @property integer sex
 * @property string birthday
 * @property string school
 * @property string occupation
 * @property string real_name
 * @property string id_card
 * @property integer is_real_name
 * @property integer fans_count
 * @property integer follow_count
 * @property string openid
 * @property string session_key
 * @property string api_token
 * @property integer status
 * @property string my_invite_code
 * @property string invite_code
 * @property integer invite_user_id
 * @property integer invite_count
 * @property float price
 * @property integer is_vip
 * @property string vip_end_time
 * @property string province_id
 * @property string city_id
 * @property string district_id
 * @property integer activity_num
 * @property integer search_num
 * @property string last_day
 * @property string images
 * @property string im_token
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class User extends ModelAbstract implements \Illuminate\Contracts\Auth\Authenticatable
{

    use Authenticatable;

    use HasDateTimeFormatter;
    protected $table = "users";

    protected $fillable = [
        'id',
        'nickname',
        'avatar',
        'phone',
        'sex',
        'birthday',
        'school',
        'occupation',
        'real_name',
        'id_card',
        'is_real_name',
        'fans_count',
        'follow_count',
        'openid',
        'session_key',
        'api_token',
        'status',
        'my_invite_code',
        'invite_code',
        'invite_user_id',
        'invite_count',
        'price',
        'is_vip',
        'vip_end_time',
        'province_id',
        'city_id',
        'district_id',
        'activity_num',
        'search_num',
        'last_day',
        'images',
        'im_token',
    ];

    protected $casts = [
        'id' => 'string',
        'nickname' => 'string',
        'avatar' => 'string',
        'phone' => 'string',
        'sex' => 'integer',
        'birthday' => 'string',
        'school' => 'string',
        'occupation' => 'string',
        'real_name' => 'string',
        'id_card' => 'string',
        'is_real_name' => 'integer',
        'fans_count' => 'integer',
        'follow_count' => 'integer',
        'openid' => 'string',
        'session_key' => 'string',
        'api_token' => 'string',
        'status' => 'integer',
        'my_invite_code' => 'string',
        'invite_code' => 'string',
        'invite_user_id' => 'integer',
        'invite_count' => 'integer',
        'price' => 'float',
        'is_vip' => 'integer',
        'vip_end_time' => 'string',
        'province_id' => 'string',
        'city_id' => 'string',
        'district_id' => 'string',
        'activity_num' => 'integer',
        'search_num' => 'integer',
        'last_day' => 'string',
        'images' => 'string',
        'im_token' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function loginInfo() {

        return [
            'id' => $this->id,

            'phone' => $this->phone,
            'nickname' => $this->nickname,
            'avatar' => $this->avatar,
            'id_card' => $this->id_card,
            'sex' => $this->sex,
            'price' => $this->price,
            'my_invite_code' => $this->my_invite_code,
            'birthday' => $this->birthday,
            'school' => $this->school,
            'occupation' => $this->occupation,
            'real_name' => $this->real_name,
            'is_real_name' => $this->is_real_name,
            'fans_count' => $this->fans_count,
            'follow_count' => $this->follow_count,
            'province' => Area::where('code',$this->province_id)->value('name'),
            'city' => Area::where('code',$this->city_id)->value('name'),
            'district' => Area::where('code',$this->district_id)->value('name'),
            'bias' => $this->bias,
            'interest' => $this->interest,
            'types' => $this->types,
            'images' => $this->images,
            'im_token' => $this->im_token,
        ];
    }
    public function bias(){
        return $this->belongsToMany(DaziBias::class,'user_bias','user_id','bias_id');
    }
    public function interest(){
        return $this->belongsToMany(Interest::class,'user_interest','user_id','interest_id');
    }
    public function follows(){
        return $this->belongsToMany(User::class,'user_follow','user_id','follow_id');
    }
    public function types(){
        return $this->belongsToMany(DaziType::class,'user_types','user_id','type_id');
    }
}
