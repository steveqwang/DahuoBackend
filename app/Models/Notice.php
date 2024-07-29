<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class Notice
 * @package App\Models
 * @property string id
 * @property string title
 * @property string content
 * @property integer status
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Notice extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "notice";

    protected $fillable = [
        'id',
        'title',
        'content',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'title' => 'string',
        'content' => 'string',
        'status' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
