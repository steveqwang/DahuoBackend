<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class UserFollow
 * @package App\Models
 * @property string id
 * @property integer user_id
 * @property integer follow_id
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class UserFollow extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "user_follow";

    protected $fillable = [
        'id',
        'user_id',
        'follow_id',
    ];

    protected $casts = [
        'id' => 'string',
        'user_id' => 'integer',
        'follow_id' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function follow()
    {
        return $this->belongsTo(User::class, 'follow_id', 'id');
    }
}
