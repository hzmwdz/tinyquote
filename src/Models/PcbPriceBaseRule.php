<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class PcbPriceBaseRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'material',
        'layers',
        'min_area_m2',
        'max_area_m2',
        'price',
        'description',
        'sort_order',
    ];
}
