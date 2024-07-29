<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class VipOrder
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property string order_no
 * @property float price
 * @property integer status
 * @property string pay_time
 * @property string pay_price
 * @property integer vip_id
 * @property string vip_title
 * @property integer days
 * @property string privilege
 * @property integer activity_num
 * @property integer pay_status
 * @property integer search_num
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class VipOrder extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "vip_order";

    protected $fillable = [
        'id',
        'user_id',
        'order_no',
        'price',
        'status',
        'pay_status',
        'pay_time',
        'pay_price',
        'vip_id',
        'vip_title',
        'days',
        'privilege',
        'activity_num',
        'search_num',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'order_no' => 'string',
        'price' => 'float',
        'status' => 'integer',
        'pay_time' => 'string',
        'pay_price' => 'string',
        'vip_id' => 'integer',
        'vip_title' => 'string',
        'days' => 'integer',
        'privilege' => 'string',
        'activity_num' => 'integer',
        'search_num' => 'integer',
        'pay_status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
