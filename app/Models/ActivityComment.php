<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class ActivityComment
 * @package App\Models
 * @property string id
 * @property integer activity_id
 * @property integer user_id
 * @property string content
 * @property integer star
 * @property string reply_content
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class ActivityComment extends ModelAbstract {

    use HasDateTimeFormatter;

    protected $table = "activity_comment";

    protected $fillable = [
        'id',
        'activity_id',
        'user_id',
        'content',
        'star',
        'reply_content',
    ];

    protected $casts = [
        'id' => 'string',
        'activity_id' => 'integer',
        'user_id' => 'integer',
        'content' => 'string',
        'star' => 'integer',
        'reply_content' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function activity() {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
}
