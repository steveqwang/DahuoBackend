<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class ActivityQa
 * @package App\Models
 * @property string id
 * @property integer activity_id
 * @property integer q_user_id
 * @property string q_content
 * @property integer status
 * @property integer a_user_id
 * @property string a_content
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ActivityQa extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "activity_qa";

    protected $fillable = [
        'id',
        'activity_id',
        'q_user_id',
        'q_content',
        'status',
        'a_user_id',
        'a_content',
    ];

    protected $casts = [
        'id' => 'string',
        'activity_id' => 'integer',
        'q_user_id' => 'integer',
        'q_content' => 'string',
        'status' => 'integer',
        'a_user_id' => 'integer',
        'a_content' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function q_user(){
        return $this->belongsTo(User::class,'q_user_id');
    }
    public function a_user(){
        return $this->belongsTo(User::class,'a_user_id');
    }
}
