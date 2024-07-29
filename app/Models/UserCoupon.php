<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserCoupon
 * @package App\Models
 * @property string id
 * @property string name
 * @property string start_time
 * @property string end_time
 * @property integer status
 * @property integer user_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserCoupon extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_coupon";

    protected $fillable = [
        'id',
        'name',
        'start_time',
        'end_time',
        'status',
        'user_id',
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'start_time' => 'string',
        'end_time' => 'string',
        'status' => 'integer',
        'user_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
