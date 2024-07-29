<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserPrice
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property float price
 * @property integer type
 * @property string remark
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property string content
 * @property string order_no
 */
class UserPrice extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_price";

    protected $fillable = [
        'id',
        'user_id',
        'price',
        'type',
        'remark',
        'content',
        'order_no',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'price' => 'float',
        'type' => 'integer',
        'remark' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'content' => 'string',
        'order_no' => 'string',
    ];
}
