<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class AssemblyPriceBomLineRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'start_lines',
        'start_price',
        'step_qty',
        'step_price',
        'description',
        'sort_order',
    ];
}
