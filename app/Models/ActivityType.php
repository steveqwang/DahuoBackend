<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class ActivityType
 * @package App\Models
 * @property string id
 * @property string title
 * @property integer status
 * @property integer sort
 * @property integer pid
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ActivityType extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "activity_type";

    protected $fillable = [
        'id',
        'title',
        'status',
        'sort',
        'pid',
    ];

    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'status' => 'integer',
        'sort' => 'integer',
        'pid' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
