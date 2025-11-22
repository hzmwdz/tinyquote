<?php

namespace Hzmwdz\Tinyquote\Models;

use Illuminate\Database\Eloquent\Model;

class PcbPriceCopperWeightRule extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'copper_oz',
        'price',
        'description',
        'sort_order',
    ];
}
