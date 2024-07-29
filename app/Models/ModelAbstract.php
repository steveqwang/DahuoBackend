<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ModelAbstract
 * @package App\Model
 * Class ModelAbstract
 * @method static $this find($id, $columns=['*']);
 * @method static $this findOrFail($id, $columns=['*'])
 * @method static $this firstOrFail($columns=['*'])
 * @method static Builder where($column, $operator = null, $value = null, $boolean = 'and')
 * @method static Builder whereIn($column, $values, $boolean = 'and', $not = false)
 * @method static Builder orderBy($column, $sort = 'asc')
 * @method static $this[] all($columns=['*'])
 * @method static Builder withoutGlobalScope(string $scope)
 * @method static int increment($column, $amount = 1, array $extra = [])
 * @method static int decrement($column, $amount = 1, array $extra = [])
 * @method static $this firstOrCreate(array $attributes, array $values = [])
 * @method static $this firstOrNew(array $attributes, array $values = [])
 * @method static $this create(array $attributes = [])
 * @method static bool insert(array $values)
 */
abstract class ModelAbstract extends Model
{
    protected $hidden = [
    ];

    protected $casts = [
    ];

    public function getCreatedAtAttribute() {
       return $this->getAttributeFromArray('created_at');
    }

    public function getUpdatedAtAttribute() {
        return $this->getAttributeFromArray('updated_at');
    }
}
