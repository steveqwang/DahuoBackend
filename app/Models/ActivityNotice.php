<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class ActivityNotice
 * @package App\Models
 * @property string id
 * @property integer activity_id
 * @property integer user_id
 * @property string title
 * @property string content
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ActivityNotice extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "activity_notice";

    protected $fillable = [
        'id',
        'activity_id',
        'user_id',
        'title',
        'content',
    ];

    protected $casts = [
        'id' => 'string',
        'activity_id' => 'integer',
        'user_id' => 'integer',
        'title' => 'string',
        'content' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
