<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserType
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer type_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserType extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_types";

    protected $fillable = [
        'id',
        'user_id',
        'type_id',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'type_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
