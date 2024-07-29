<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserTi
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property float price
 * @property integer status
 * @property string remark
 * @property string ti_time
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserTi extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_ti";

    protected $fillable = [
        'id',
        'user_id',
        'price',
        'status',
        'remark',
        'ti_time',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'price' => 'float',
        'status' => 'integer',
        'remark' => 'string',
        'ti_time' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
