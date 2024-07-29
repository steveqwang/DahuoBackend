<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class ActivitySign
 * @package App\Models
 * @property string id
 * @property integer activity_id
 * @property integer sex
 * @property integer user_id
 * @property string order_no
 * @property string name
 * @property string phone
 * @property string emergency_contact
 * @property string emergency_contact_phone
 * @property integer pay_status
 * @property integer type
 * @property float price
 * @property string pay_time
 * @property string cancel_reason
 * @property string cancel_explain
 * @property float pay_price
 * @property integer status
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ActivitySign extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "activity_sign";

    protected $fillable = [
        'id',
        'activity_id',
        'sex',
        'user_id',
        'order_no',
        'name',
        'phone',
        'emergency_contact',
        'emergency_contact_phone',
        'pay_status',
        'price',
        'pay_time',
        'pay_price',
        'cancel_explain',
        'status',
        'sex',
        'type',
        'cancel_reason',
    ];

    protected $casts = [
        'id' => 'string',
        'activity_id' => 'integer',
        'user_id' => 'integer',
        'order_no' => 'string',
        'name' => 'string',
        'phone' => 'string',
        'emergency_contact' => 'string',
        'emergency_contact_phone' => 'string',
        'pay_status' => 'integer',
        'price' => 'float',
        'pay_time' => 'string',
        'cancel_reason' => 'string',
        'cancel_explain' => 'string',
        'pay_price' => 'float',
        'status' => 'integer',
        'type' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function activity() {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
}
