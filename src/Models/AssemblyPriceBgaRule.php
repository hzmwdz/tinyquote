<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class AssemblyPriceBgaRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'min_count',
        'max_count',
        'price',
        'description',
        'sort_order',
    ];
}
