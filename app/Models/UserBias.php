<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserBias
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer bias_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserBias extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_bias";

    protected $fillable = [
        'id',
        'user_id',
        'bias_id',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'bias_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
