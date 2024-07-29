<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class ActivityNotLike
 * @package App\Models
 * @property string id
 * @property integer activity_id
 * @property integer user_id
 * @property string reason
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ActivityNotLike extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "activity_not_like";

    protected $fillable = [
        'id',
        'activity_id',
        'user_id',
        'reason',
    ];

    protected $casts = [
        'id' => 'string',
        'activity_id' => 'integer',
        'user_id' => 'integer',
        'reason' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
