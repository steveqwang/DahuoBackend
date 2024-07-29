<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull as ConvertEmptyStringsToNulls;
class ConvertEmptyStringsToNull extends ConvertEmptyStringsToNulls
{
    /**
     * Transform the given value.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    protected function transform($key, $value)
    {
        if(strlen($key)>5 && substr($key,-3)=='.id'){
            return is_string($value) && $value === '' ? null : $value;
        }else{
            return $value;
        }
    }
}
