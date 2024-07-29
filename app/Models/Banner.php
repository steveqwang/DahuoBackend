<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use App\Models\ModelAbstract;
use Dcat\Admin\Traits\HasDateTimeFormatter;
/**
 * Class Banner
 * @package App\Models
 * @property string id
 * @property string img
 * @property integer sort
 * @property integer status
 * @property string title
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Carbon deleted_at
 */
class Banner extends ModelAbstract {

    use SoftDeletes;
    use HasDateTimeFormatter;

    protected $table = "banner";

    protected $fillable = [
        'id',
        'img',
        'sort',
        'status',
        'title',
    ];

    protected $casts = [
        'id' => 'string',
        'img' => 'string',
        'sort' => 'integer',
        'status' => 'integer',
        'title' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
}
