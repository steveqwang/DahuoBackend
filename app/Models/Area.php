<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class Area
 * @package App\Models
 * @property integer id
 * @property integer parent_id
 * @property string code
 * @property string name
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Area extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "china_area";

    protected $fillable = [
        'id',
        'parent_id',
        'code',
        'name',
    ];

    protected $casts = [
        'id' => 'integer',
        'parent_id' => 'integer',
        'code' => 'string',
        'name' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
