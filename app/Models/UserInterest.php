<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserInterest
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer interest_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserInterest extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_interest";

    protected $fillable = [
        'id',
        'user_id',
        'interest_id',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'interest_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
