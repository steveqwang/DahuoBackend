<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class Activity
 * @package App\Models
 * @property string id
 * @property string pid
 * @property string title
 * @property integer activity_type_id
 * @property string image
 * @property string images
 * @property integer user_id
 * @property integer status
 * @property string activity_date
 * @property string start_time
 * @property string end_time
 * @property string sign_up_end_time
 * @property integer activity_number
 * @property integer sign_up_number
 * @property string address
 * @property string content
 * @property string longitude
 * @property string latitude
 * @property integer read_number
 * @property integer nan_num
 * @property integer nv_num
 * @property integer type
 * @property float price
 * @property float underlined_price
 * @property integer is_open
 * @property integer is_prohibit
 * @property string province_id
 * @property string city_id
 * @property string district_id
 * @property string province
 * @property string city
 * @property string district
 * @property string activity_address
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Activity extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "activity";

    protected $fillable = [
        'id',
        'pid',
        'title',
        'activity_type_id',
        'image',
        'images',
        'user_id',
        'status',
        'activity_date',
        'start_time',
        'end_time',
        'sign_up_end_time',
        'activity_number',
        'sign_up_number',
        'address',
        'content',
        'longitude',
        'latitude',
        'read_number',
        'price',
        'is_open',
        'is_prohibit',
        'nv_num',
        'nan_num',
        'underlined_price',
        'province_id',
        'city_id',
        'district_id',
        'province',
        'city',
        'district',
        'type',
        'activity_address',
    ];

    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'activity_type_id' => 'integer',
        'pid' => 'integer',
        'image' => 'string',
        'images' => 'string',
        'user_id' => 'integer',
        'status' => 'integer',
        'activity_date' => 'string',
        'start_time' => 'string',
        'end_time' => 'string',
        'sign_up_end_time' => 'string',
        'activity_number' => 'integer',
        'sign_up_number' => 'integer',
        'address' => 'string',
        'content' => 'string',
        'longitude' => 'string',
        'latitude' => 'string',
        'read_number' => 'integer',
        'price' => 'float',
        'underlined_price' => 'float',
        'is_open' => 'integer',
        'is_prohibit' => 'integer',
        'nv_num' => 'integer',
        'nan_num' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'province_id' => 'string',
        'city_id' => 'string',
        'district_id' => 'string',
        'province' => 'string',
        'city' => 'string',
        'district' => 'string',
        'activity_address' => 'string',
        'type' => 'integer',
    ];
    public function activityType(){
        return $this->belongsTo(ActivityType::class,'activity_type_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function activitySign(){
        return $this->belongsToMany(User::class,'activity_sign','activity_id','user_id')->where('activity_sign.status',1);
    }
    public function sign(){
        return $this->hasMany(ActivitySign::class,'activity_id','id');
    }
    public function activityComment(){
        return $this->hasMany(ActivityComment::class,'activity_id','id');
    }
    public function ActivityQa(){
        return $this->hasMany(ActivityQa::class,'activity_id','id');
    }
    public function activityCollect(){
        return $this->belongsToMany(User::class,'user_collection','activity_id','user_id');
    }

    public function setProvinceIdAttribute($value){
        $this->attributes['province'] = Area::where('code',$value)->value('name');
        $this->attributes['province_id'] = $value;
    }
    public function setCityIdAttribute($value){
        $this->attributes['city'] = Area::where('code',$value)->value('name');
        $this->attributes['city_id'] = $value;
    }
    public function setDistrictIdAttribute($value){
        $this->attributes['district'] = Area::where('code',$value)->value('name');
        $this->attributes['district_id'] = $value;
    }


     public function is_like(){
        return $this->hasMany(UserLike::class,'activity_id','id');
     }
}
