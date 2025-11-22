<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class AssemblyPriceBaseRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'is_double_side',
        'price',
        'description',
        'sort_order',
    ];
}
