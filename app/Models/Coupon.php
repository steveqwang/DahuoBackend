<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class Coupon
 * @package App\Models
 * @property string id
 * @property string name
 * @property integer status
 * @property string start_time
 * @property string end_time
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Coupon extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "coupon";

    protected $fillable = [
        'id',
        'name',
        'status',
        'start_time',
        'end_time',
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'status' => 'integer',
        'start_time' => 'string',
        'end_time' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
