<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class Vip
 * @package App\Models
 * @property string id
 * @property string title
 * @property integer status
 * @property integer sort
 * @property float price
 * @property float underlined_price
 * @property integer days
 * @property string privilege
 * @property integer activity_num
 * @property integer search_num
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Vip extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "vip";

    protected $fillable = [
        'id',
        'title',
        'status',
        'sort',
        'price',
        'underlined_price',
        'days',
        'privilege',
        'activity_num',
        'search_num',
    ];

    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'status' => 'integer',
        'sort' => 'integer',
        'price' => 'float',
        'underlined_price' => 'float',
        'days' => 'integer',
        'privilege' => 'string',
        'activity_num' => 'integer',
        'search_num' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
