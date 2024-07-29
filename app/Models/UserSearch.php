<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserSearch
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property string search_date
 * @property integer search_num
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserSearch extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_search";

    protected $fillable = [
        'id',
        'user_id',
        'search_date',
        'search_num',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'search_date' => 'string',
        'search_num' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
