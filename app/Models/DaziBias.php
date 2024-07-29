<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class DaziBias
 * @package App\Models
 * @property string id
 * @property string title
 * @property integer status
 * @property integer sort
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class DaziBias extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "dazi_bias";

    protected $fillable = [
        'id',
        'title',
        'status',
        'sort',
    ];

    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'status' => 'integer',
        'sort' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
