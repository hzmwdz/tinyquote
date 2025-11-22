<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class AssemblyPriceThtRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'min_count',
        'max_count',
        'leadtime_hours',
        'price',
        'description',
        'sort_order',
    ];
}
