<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserCollection
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer activity_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserCollection extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_collection";

    protected $fillable = [
        'id',
        'user_id',
        'activity_id',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'activity_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
