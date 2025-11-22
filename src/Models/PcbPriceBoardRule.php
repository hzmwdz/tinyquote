<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class PcbPriceBoardRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'material',
        'layers',
        'min_area_m2',
        'max_area_m2',
        'leadtime_hours',
        'price',
        'description',
        'sort_order',
    ];
}
